<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Session;

class TipoReceita extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'default';

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->connection = Session::get("CONNECTION");
    }

    protected $fillable = ['name', 'valor'];
}
