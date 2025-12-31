<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SawSubCriteria extends Model
{
    protected $fillable = ['saw_criteria_id', 'name', 'weight'];

    public function criteria()
    {
        return $this->belongsTo(SawCriteria::class, 'saw_criteria_id');
    }
}
