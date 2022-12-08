<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public array $admin = array(
        1 =>"GETapi/rol",
        2 =>"POSTapi/rol",
        3 =>"PUTapi/rol",
        4 =>"DELETEapi/rol",
        5 =>"GETapi/asignatura",
        6 =>"PUTapi/asignatura",
        7 =>"POSTapi/asignatura",
        8 =>"DELETEapi/asignatura",
        9 =>"GETapi/usuario",
        10 =>"POSTapi/usuario",
        11 =>"DELETEapi/usuario",
        12 =>"GETapi/docente",
    );
    public $autor = array(
        1 =>"GETapi/asignatura",
        2 =>"GETapi/usuario",
        3 =>"GETapi/rol",
        12 =>"GETapi/docente",
    );
    public $lector = array(
        1 =>"GETapi/asignatura",
        2 =>"GETapi/usuario",
        3 =>"GETapi/rol",
        12 =>"GETapi/docente",
    );
    public function handle(Request $request, Closure $next)
    {
        $key = env("JWT_SECRET");
        $mensaje = "No esta autorizado para acceder a esta ruta";

        $path = explode("/",$request->method().$request->path());
        $rutaValidar = $path[0]."/".$path[1];

        if(is_null($request->header('Authorization'))){
            return response($mensaje,401);
        }
        $jwt =explode(" ",$request->header('Authorization'))[1];
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $array = json_decode(json_encode($decoded), true);

        if(!is_null($array["rol"]) && $array["rol"] != ""){
            if($array["rol"] == "COORD"){
                $indice = array_search($rutaValidar, $this->admin);
                if($indice){
                    return $next($request);
                }
                return response($mensaje,401);
            }
            if($array["rol"] == "PROF"){
                $indice = array_search($rutaValidar, $this->autor);
                if($indice){
                    return $next($request);
                }
                return response($mensaje,401);
            }
            if($array["rol"] == "EST"){
                $indice = array_search($rutaValidar, $this->lector);
                if($indice){
                    return $next($request);
                }
                return response($mensaje,401);
            }
        }
        return response($mensaje,401);
    }
}
