<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Session;

class TipoPagamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $connection = 'default';

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->connection = Session::get("CONNECTION");
    }
}

