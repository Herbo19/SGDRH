<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipa extends Model
{
    protected $primaryKey = 'idEquipa';
    protected $fillable = ['nome_equipa','descricao'];
    use HasFactory;


    public function metas()
    {
        return $this->hasMany(Meta::class);
    }

    public function funcionario()
    {
        return $this->belongsToMany(Funcionario::class, 'equipa_funcionario', 'team_id', 'employee_id')->withTimestamps();
    }

}
