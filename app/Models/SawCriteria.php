<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SawCriteria extends Model
{
    protected $fillable = ['code', 'name', 'attribute', 'weight', 'description', 'is_active'];

    public function subCriterias()
    {
        return $this->hasMany(SawSubCriteria::class, 'saw_criteria_id');
    }
}
