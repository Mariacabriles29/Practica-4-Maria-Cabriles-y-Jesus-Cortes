<?php

namespace Revisiones\Http\Controllers;

use Illuminate\Http\Request;
use Revisiones\Profesor;
use Revisiones\Evaluacion;
use Revisiones\Revision;
use Revisiones\Alumno;
use Session;


class principalController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function evaluacion()
    {
    	return view('evaluacion');
    }

    public function revision()
    {
        $evaluaciones = Evaluacion::where('activa','=','1')->get();
    	
        return view('revision', array('evaluaciones' => $evaluaciones ));
    }

    public function corregir()
    {
    	$evaluaciones = Evaluacion::where('id_profesor','=',Session::get('user')->id)->
                        where('activa','=','1')->get();

        $id_evs = array();
        for ($i=0; $i <count($evaluaciones) ; $i++)
        { 
          $id_evs[$i]=$evaluaciones[$i]->id;
        }

        $revisiones = Revision::whereIn('id_evaluacion',$id_evs)->get();

        $ev = array();
        $alumn = array();
        for ($i=0; $i <count($revisiones) ; $i++)
        { 
            $e = Evaluacion::find($revisiones[$i]->id_evaluacion);
            $a = Alumno::where('id_revision','=',$revisiones[$i]->id)->orderBy('id')->get();
            $ev[$i] = $e;
            $alumn[$i] = $a;
        }

        return view('corregir',array('revisiones' => $revisiones, 'ev' => $ev, 'alumn' => $alumn));
    }
        
    public function insertar_revisiones(Request $request)
    {
        $id_evaluacion = $request->get('id_evaluacion')+0;
        $nota = $request->get('nota');
        $enlace = $request->get('enlace');

        if($id_evaluacion>0 && $enlace!="")
        {
            $max = $request->get('max')+0;
            $total = 0;

            $r = new Revision();
            $r->fill(['id_evaluacion'=>$id_evaluacion,
                      'nota'=>$nota,
                      'enlace'=>$enlace]);
            $r->save();

            for ($i=0; $i < $max; $i++)
            { 
               $nombre = $request->get('nombre')[$i];
               $apellido = $request->get('apellido')[$i];
               $cedula = $request->get('cedula')[$i];

               if($nombre!="" && $apellido!="" && $cedula!="")
               {
                    $a = new Alumno();
                    $a->fill(['id_revision'=>$r->id,
                              'nombre'=>$nombre,
                              'apellido'=>$apellido,
                              'cedula'=>$cedula]);
                          
                    $a->save();
                    $total = $total+1;
               }
            }

            if($total>0)
            {
               return true;       
            }
            else
            {
               $r->delete(); 
               return false;                
            }
        }
        return false;
    }

    public function insertar_evaluacion(Request $request)
    {
        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha','1900-01-01');
        $puntos_max = $request->get('puntos_max')+0;
        $parcial = $request->get('parcial')+0;
        $activa = $request->get('activa')+0;

        if($nombre!="" && $fecha!="" && $puntos_max>0 && $puntos_max<=100)
        {
            $e = new Evaluacion();
            $e->fill(['id_profesor'=>Session::get('user')->id,
                      'nombre'=>$nombre,
                      'fecha'=>$fecha,
                      'puntos_max'=>$puntos_max,
                      'parcial'=>$parcial,
                      'activa'=>$activa]);
            $e->save();
            return true;
        }
        return false;
    }


    public function recibir_data(Request $request)
    {
        $hidden = $request->get('hidden');
        if($hidden=="evaluacion")
        {
            $res=$this->insertar_evaluacion($request);
            if($res)
            {
               Session::flash('exito','evaluación creada correctamente');
            }
            else
            {
               Session::flash('error','error al crear evaluación');
            }
            return redirect('evaluacion');
        }
        if($hidden=="revision")
        {
            $res=$this->insertar_revisiones($request);
            if($res)
            {
               Session::flash('exito','revisión creada correctamente');
            }
            else
            {
               Session::flash('error','error al crear revisión');
            }
            return redirect('/');
        }
    }

    public function asignar($id,$val)
    {
        $r = Revision::find($id);
        $e = Evaluacion::find($r->id_evaluacion);

        if($val<=$e->puntos_max)
        {
            $r->calificacion = $val;
            $r->save();
        }
        else
        {
            Session::flash('error','error al corregir revisión'); 
        }
        return redirect('corregir');
    }

    public function login(Request $request)
    {
        $p = Profesor::where('usuario','=',$request->get('usuario'))->
                  where('clave','=',$request->get('clave'))->first();
        if($p)
        {
            Session::put('user',$p);
        }
        else
        {
            Session::flash('error','usuario o contraseña incorreta');             
        }
        return redirect('/');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/');   
    }
}
