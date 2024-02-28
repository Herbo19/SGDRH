<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $primaryKey = 'idCriterio';
    protected $fillable = ['criterio'];
    use HasFactory;
}
