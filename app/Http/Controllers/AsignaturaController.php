<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignatura;
use App\Models\usuario;
use App\Models\rol;


class AsignaturaController extends Controller
{
    public function getAll(){
        return response()->json(Asignatura::all(),200);
    }

    public function getById($id){
        $post = Asignatura::find($id);

        if(is_null($post)){
            return response()->json(["message"=>'Asiganura no encontrada'], 404);
        };        
        return response()->json($post, 200);
    }

    public function createAsignatura(Request $request){
        $requestCopy = $request->all();

        $validar = $this->validarCreacion($request);
        if(!$validar){
            return response()->json("La informacion que ingreso no corresponde a la solicitada para que la creación de la asignatura sea ejecutada", 404);
        }

        $post =Asignatura::create($requestCopy);

        return response()->json($post, 200);

    }
    public function updateAsignatura(Request $request, $id){
        $requestCopy = $request->all();

        $validar = $this->validarCreacion($request);

        if(!$validar){
            return response()->json("La informacion que ingreso no corresponde a la solicitada para que la asignatura sea actualizada", 404);
        }

        $asignatura = Asignatura::find($id);

        if($asignatura == null){
            return response()->json("La asignatura que intenta actualizar no existe", 404);
        }

        $asignaturaUpdate = $asignatura->update($requestCopy);

        return response()->json($asignaturaUpdate, 200);
    }

    public function deleteAsignatura($id){
        $asignatura = Asignatura::find($id);

        if(is_null($asignatura)){
            return response()->json(["message" => "La asignatura que intenta eliminar no existe en la base de datos"], 404);
        }

        $asignatura->delete();

        return response()-> json(["message" => "Asignatura eliminada con exito"], 200);

    }

    public function validarCreacion($request){
        $nombre = $request->all()["nombre"];
        $creditos = $request->all()["creditos"];
        $id_docente = $request->all()["id_docente"];
        $prerrequisito = $request->all()["prerrequisito"];
        $trabajoAutonomo = $request->all()["trabajoAutonomo"];
        $trabajoDirigido = $request->all()["trabajoDirigido"];

        if($nombre == null || $creditos == null || $id_docente == null || $prerrequisito == null || $trabajoAutonomo == null || $trabajoDirigido == null){
            return false;
        }

        $usuario = usuario::find($id_docente);

        if(is_null($usuario)) {
            return false;
        }
        $rol = rol::find($usuario["id_rol"]);
        $nombreRol =$rol["nombre"];
        
        if($nombreRol != "PROF" ){
            return false;
        }
        return true;
    }
}
