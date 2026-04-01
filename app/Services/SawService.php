<?php

namespace App\Services;

use App\Models\SawCriteria;
use App\Models\Ticket;
use Carbon\Carbon;

class SawService
{
    public function calculateScore(Ticket $ticket)
    {
        // Fallback for single ticket (e.g., when saving). 
        // Real dynamic calculation is done in calculateScores() for a collection.
        $criterias = SawCriteria::with('subCriterias')->where('is_active', true)->get();
        $score = 0;

        foreach ($criterias as $criteria) {
            $weight = $criteria->weight;
            $val = 0;
            $code = strtoupper($criteria->code);

            switch ($code) {
                case 'C1':
                    $val = $this->getSubCriteriaWeight($criteria, $ticket->urgency);
                    break;
                case 'C2':
                    $type = $ticket->inventory && $ticket->inventory->category ? $ticket->inventory->category->name : '';
                    $val = $this->getSubCriteriaWeight($criteria, $type);
                    break;
                case 'C3':
                    if ($ticket->inventory) {
                         if ($ticket->inventory->user_id && $ticket->inventory->user_id == $ticket->user_id) {
                             $val = $this->getSubCriteriaWeight($criteria, 'Perorangan');
                         } else {
                             $val = $this->getSubCriteriaWeight($criteria, 'Divisi / Departemen');
                         }
                    } else {
                        $val = 0;
                    }
                    break;
                case 'C4':
                    $dept = $ticket->user->department ?? '';
                    $val = $this->getSubCriteriaWeight($criteria, $dept);
                    break;
            }

            if (strtolower($criteria->attribute) === 'cost') {
                $val = 1.0 - $val;
            }
            
            $score += $weight * $val;
        }

        return $score;
    }

    public function calculateScores($tickets)
    {
        if ($tickets->isEmpty()) return $tickets;

        $criterias = SawCriteria::with('subCriterias')->where('is_active', true)->get();
        
        $matrix = [];
        // 1. Matriks Keputusan (X)
        foreach ($tickets as $idx => $ticket) {
            foreach ($criterias as $criteria) {
                $code = strtoupper($criteria->code);
                $val = 0;
                
                switch ($code) {
                    case 'C1':
                        $val = $this->getSubCriteriaWeight($criteria, $ticket->urgency);
                        break;
                    case 'C2':
                        $type = $ticket->inventory && $ticket->inventory->category ? $ticket->inventory->category->name : '';
                        $val = $this->getSubCriteriaWeight($criteria, $type);
                        break;
                    case 'C3':
                        if ($ticket->inventory) {
                             if ($ticket->inventory->user_id && $ticket->inventory->user_id == $ticket->user_id) {
                                 $val = $this->getSubCriteriaWeight($criteria, 'Perorangan');
                             } else {
                                 $val = $this->getSubCriteriaWeight($criteria, 'Divisi / Departemen');
                             }
                        } else {
                            $val = 0;
                        }
                        break;
                    case 'C4':
                        $dept = $ticket->user->department ?? '';
                        $val = $this->getSubCriteriaWeight($criteria, $dept);
                        break;
                }
                $matrix[$idx][$code] = (float) $val;
            }
        }

        // 2. Cari Min dan Max
        $minMax = [];
        foreach ($criterias as $criteria) {
            $code = strtoupper($criteria->code);
            $values = array_column($matrix, $code);
            $minMax[$code] = [
                'min' => !empty($values) ? min($values) : 0,
                'max' => !empty($values) ? max($values) : 0,
            ];
        }

        // 3. Normalisasi (R) dan Perhitungan Nilai Preferensi (V)
        foreach ($tickets as $idx => $ticket) {
            $score = 0;
            foreach ($criterias as $criteria) {
                $code = strtoupper($criteria->code);
                $rawVal = $matrix[$idx][$code];
                $max = $minMax[$code]['max'];
                $min = $minMax[$code]['min'];
                $weight = (float) $criteria->weight;

                $normalized = 0;
                if (strtolower($criteria->attribute) === 'benefit') {
                    $normalized = ($max > 0) ? ($rawVal / $max) : 0;
                } else { // cost
                    $normalized = ($rawVal > 0) ? ($min / $rawVal) : (($min == 0 && $rawVal == 0) ? 0 : 0);
                }

                $score += $weight * $normalized;
            }
            $ticket->saw_score = $score;
        }

        return $tickets;
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
