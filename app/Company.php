<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'fancy_name',
        'company_name',
        'CNPJ',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profiles()
    {
        return $this->hasMany(CompanyProfile::class);
    }
}
