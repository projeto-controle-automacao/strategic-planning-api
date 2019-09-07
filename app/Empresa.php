<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'missao',
        'visao',
        'valores',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
