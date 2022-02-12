<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadosController extends Controller
{
    function obtenerLista()
	{
		$empleados =  Empleado::all();


		$response = new \stdClass();
		$response->success=true;
		$response->data=$empleados;

		return response()->json($response,200);
	}

    function obtenerItem($id)
	{
		$empleado =  Empleado::find($id);


		$response = new \stdClass();
		$response->success=true;
		$response->data=$empleado;

		return response()->json($response,200);
	}

	function update(Request $request)
	{
		$empleado =  Empleado::find($request->id);

		if($empleado)
		{
			$empleado->nombre=$request->nombre;
			$empleado->apellidos=$request->apellidos;
            $empleado->cargo=$request->cargo;
            $empleado->nacionalidad=$request->nacionalidad;
			$empleado->save();
		}

		$response = new \stdClass();
		$response->success=true;
		$response->data=$empleado;

		return response()->json($response,200);
	}

	


	function store(Request $request)
	{
		$empleado = new Empleado();
		$empleado->nombre=$request->nombre;
		$empleado->apellidos=$request->apellidos;
        $empleado->cargo=$request->cargo;
        $empleado->nacionalidad=$request->nacionalidad;
		$empleado->save();

		$response = new \stdClass();
		$response->success=true;
		$response->data=$empleado;

		return response()->json($response,200);
	}

	function delete($id)
	{
		$response = new \stdClass();
		$response->success=true;
		$response_code=200;


		$empleado = Empleado::find($id);

		if($empleado)
		{
			$empleado->delete();
			$response->success=true;
			$response_code=200;
		}
		else
		{
			$response->error=["El empleado ya ha sido eliminado"];
			$response->success=false;
			$response_code=500;
		}

		return response()->json($response,$response_code);

	}
}
