<?php

namespace Revisiones;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = "evaluaciones";

    protected $fillable = ['id_profesor','nombre','fecha','puntos_max','parcial','activa'];

    public $timestamps = false;
}
