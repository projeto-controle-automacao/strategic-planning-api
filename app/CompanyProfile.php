<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profile';
    protected $fillable = [
        'mission',
        'vision',
        'values',
        'strategic_plan',
        'deadline',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
