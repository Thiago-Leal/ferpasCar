<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TipoCusto;
use Session;

class Custo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'tipo_custo_id', 'valor'];

    protected $connection = 'default';

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->connection = Session::get("CONNECTION");
    }

    public function tipo_custo()
    {
    	return $this->belongsTo(TipoCusto::class);
    }
}
