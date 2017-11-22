<?php

namespace Revisiones;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = "revisiones";

    protected $fillable = ['id_evaluacion','nota','calificacion','enlace'];

    public $timestamps = false;
}
