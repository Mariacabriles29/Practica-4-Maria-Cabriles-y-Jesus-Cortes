<?php

namespace Revisiones;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = "alumnos";

    protected $fillable = ['id_revision','nombre','apellido','cedula'];

    public $timestamps = false;
}
