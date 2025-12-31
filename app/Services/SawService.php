<?php

namespace App\Services;

use App\Models\SawCriteria;
use App\Models\Ticket;
use Carbon\Carbon;

class SawService
{
    public function calculateScore(Ticket $ticket)
    {
        $criterias = SawCriteria::with('subCriterias')->get();
        $score = 0;

        foreach ($criterias as $criteria) {
            $weight = $criteria->weight;
            $val = 0;
            $code = strtoupper($criteria->code);

            switch ($code) {
                case 'C1': // Tingkat Urgensi
                    $val = $this->getSubCriteriaWeight($criteria, $ticket->urgency);
                    break;
                case 'C2': // Jenis Aset
                    $type = $ticket->inventory ? $ticket->inventory->type : '';
                    $val = $this->getSubCriteriaWeight($criteria, $type);
                    break;
                case 'C3': // Status Garansi
                    $status = $this->resolveWarrantyStatus($ticket->inventory ? $ticket->inventory->warranty_expiry : null);
                    $val = $this->getSubCriteriaWeight($criteria, $status);
                    break;
                case 'C4': // Jabatan Pengguna
                    $dept = $ticket->user->department ?? '';
                    $val = $this->getSubCriteriaWeight($criteria, $dept);
                    break;
            }

            $score += $weight * $val;
        }

        return $score;
    }

    private function getSubCriteriaWeight($criteria, $value)
    {
        if (empty($value)) return 0;

        $value = strtolower(trim($value));

        // Find matching sub-criteria
        // We try exact match first
        $sub = $criteria->subCriterias->first(function ($sub) use ($value) {
            return strtolower($sub->name) === $value;
        });

        if ($sub) return $sub->weight;

        // If no exact match, try partial match for assets/roles if strictly needed, 
        // but for now let's stick to startswith/contains for flexibility if exact fails
        $sub = $criteria->subCriterias->first(function ($sub) use ($value) {
            return str_contains($value, strtolower($sub->name)) || str_contains(strtolower($sub->name), $value);
        });

        return $sub ? $sub->weight : 0;
    }

    private function resolveWarrantyStatus($expiryDate)
    {
        if (!$expiryDate) return 'Unknown';
        $expiry = Carbon::parse($expiryDate);
        return $expiry->isFuture() ? 'Active' : 'Expired';
    }
}
