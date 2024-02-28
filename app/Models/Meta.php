<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $primaryKey = 'idMeta';
    const STATUS_NOT_DONE = 'não concluida';
    const STATUS_DONE = 'concluida';
    use HasFactory;

    function titulos(){
        return $this->belongsTo(Titulo::class,'idTitulo');
    }
    function estado_metas(){
        return $this->belongsTo(Estado_meta::class,'idEstadoMeta');
    }
    function funcionario(){
        return $this->belongsTo(Funcionario::class,'atribuir_para');
    }
    function user(){
        return $this->belongsTo(User::class,'atribuido_por');
    }

    public function equipas()
    {
        return $this->belongsTo(Equipa::class, 'idEquipa');
    }
}
