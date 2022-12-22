<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Session;

class Receita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'valor', 'tipo_receita_id', 'tipo_pagamento_id'];

    protected $connection = 'default';

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->connection = Session::get("CONNECTION");
    }

    public function tipo_receita()
    {
    	return $this->belongsTo(TipoReceita::class);
    }

    public function tipo_pagamento()
    {
    	return $this->belongsTo(TipoPagamento::class);
    }
}
