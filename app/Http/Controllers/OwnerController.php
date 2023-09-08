<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\owner;
use Illuminate\Database\QueryException;

class OwnerController extends Controller
{
    //
    public function save(Request $request)
    {

        try {
            $model = new owner();
            $model->number_cc = $request->ccnumber;
            $model->first_name = $request->name;
            $model->middle_name = $request->middleName;
            $model->last_name = $request->lastName;
            $model->address = $request->address;
            $model->phone_number = $request->phoneNumber;
            $model->id_city = $request->city;
            $model->save();

            if ($model->save()) {
                return response()->json(['mensaje' => 'Modelo guardado con exito', 'estado' => 'exito']);
            } else {
                return response()->json(['mensaje' => 'Error al guardar el modelo', 'estado' => 'error']);
            }
        } catch (QueryException $e) {
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 400);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
    public function get()
    {

        try {
            $owners = Owner::all();

            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $owners, 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }

    public function getOwner($id)
    {
        try {

            $resultado = owner::select('owners.id_owner', 'owners.number_cc', 'owners.first_name', 'owners.middle_name', 'owners.last_name', 'owners.address', 'owners.phone_number', 'cities.name as city')
            ->join('cities', 'owners.id_city', '=', 'cities.id_city')
            ->where('owners.id_owner', '=', $id)
            ->get();
            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $resultado[0], 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
}
