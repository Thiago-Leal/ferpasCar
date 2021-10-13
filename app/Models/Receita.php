<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'valor', 'tipo_receita_id'];

    public function tipo_receita()
    {
    	return $this->belongsTo(TipoReceita::class);
    }
}
