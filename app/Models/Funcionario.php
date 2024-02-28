<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{

    public $directory="/imagens/";

    use HasFactory;

    function departamento(){
      return $this->belongsTo(Departamento::class,'id_departamento');
    }

    function cargos(){
        return $this->belongsTo(Cargo::class,'id_cargo');
    }



    function generos(){
      return $this->belongsTo(Genero::class,'idGenero');
    }

    function estados(){
        return $this->belongsTo(Estado::class,'idEstado');
    }

    function emails(){
        return $this->belongsTo(Email::class,'idEmail');
    }

    function telefones(){
        return $this->belongsTo(Telefone::class,'idTelefone');
    }

    public function equipas()
    {
        return $this->belongsToMany(Equipa::class, 'equipa_funcionario', 'employee_id', 'team_id');
    }


    function getFotoAttribute($value){
        if ($value == "/imagens") {
            $df = '/imagens';
            $trimmed = str_replace($df, '', $value) ;
            return $this->directory.$trimmed;
            if ($trimmed == "/imagens") {
                $dfa = '/imagens';
                $trim = str_replace($dfa, '', $trimmed) ;
                return $this->directory.$trim;
            }
        }
        return $this->directory.$value;
    }

}
