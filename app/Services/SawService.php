<?php

namespace App\Services;

use App\Models\SawCriteria;
use App\Models\Ticket;
use Carbon\Carbon;

class SawService
{
    public function calculateScore(Ticket $ticket)
    {
        $criterias = SawCriteria::with('subCriterias')->where('is_active', true)->get();
        $score = 0;

        foreach ($criterias as $criteria) {
            $weight = $criteria->weight;
            $val = 0;
            $code = strtoupper($criteria->code);

            switch ($code) {
                case 'C1': // Tingkat Urgensi
                    // Screenshot shows: high (1.00), medium (0.66), low (0.33)
                    // Form sends: high, medium, low
                    $val = $this->getSubCriteriaWeight($criteria, $ticket->urgency);
                    break;
                
                case 'C2': // Jenis Aset
                    // Screenshot shows: Network, Server, etc.
                    // Managed automatically via Asset Category
                    // We must match $ticket->inventory->category->name exactly or closely
                    $type = $ticket->inventory && $ticket->inventory->category ? $ticket->inventory->category->name : '';
                    $val = $this->getSubCriteriaWeight($criteria, $type);
                    break;

                case 'C3': // Pengguna Aset
                    // Screenshot shows: "Perorangan" (0.50), "Divisi / Departemen" (1.00)
                    if ($ticket->inventory) {
                         // Check explicit user_id match for Personal
                         if ($ticket->inventory->user_id && $ticket->inventory->user_id == $ticket->user_id) {
                             $val = $this->getSubCriteriaWeight($criteria, 'Perorangan');
                         } else {
                             // Default to Department
                             $val = $this->getSubCriteriaWeight($criteria, 'Divisi / Departemen');
                         }
                    } else {
                        $val = 0;
                    }
                    break;

                case 'C4': // Jabatan Pengguna
                    // Screenshot shows: Direktur, Divisi IT, Manager, Divisi Desain, etc.
                    // This seems to map to Department Names or Role Titles.
                    // We will use User's Department name.
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

        // Normalize value
        $value = strtolower(trim($value));

        // Mapping for specific codes to match typical Indonesian Admin entries
        $code = strtoupper($criteria->code);
        
        // Note: C1 (Urgency) uses 'low', 'medium', 'high' in both form and DB, so no mapping needed
        // The mapping below was incorrect as DB uses English terms, not Indonesian
        
        // Map Warranty (Code: Active/Expired -> DB: Aktif/Habis) - for C3 if needed
        // Note: This mapping is not currently used as C3 logic is different
        if ($code === 'C3') {
            $map = [
                'active' => 'aktif',
                'expired' => 'habis'
            ];
            $value = $map[$value] ?? $value;
        }

        // Find matching sub-criteria
        // 1. Try exact match (normalized) - case insensitive
        $sub = $criteria->subCriterias->first(function ($sub) use ($value) {
            return strtolower(trim($sub->name)) === $value;
        });

        if ($sub) return $sub->weight;

        // 2. Try partial match (contains) - for flexible matching
        $sub = $criteria->subCriterias->first(function ($sub) use ($value) {
            $dbName = strtolower(trim($sub->name));
            return str_contains($value, $dbName) || str_contains($dbName, $value);
        });

        return $sub ? $sub->weight : 0;
    }


}
