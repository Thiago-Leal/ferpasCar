<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TipoCusto;

class Custo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'tipo_custo_id', 'valor'];

    public function tipo_custo()
    {
    	return $this->belongsTo(TipoCusto::class);
    }
}
