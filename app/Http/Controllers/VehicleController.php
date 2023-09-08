<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehiculo;
use App\Models\owner;
use App\Models\brand;
use App\Models\city;
use Illuminate\Database\QueryException;

class VehicleController extends Controller
{
    //
    public function save(Request $request)
    {

        try {
            $request->validate([
                'plate' => 'required',
                'brand' => 'required',
                'type' => 'required',
                'color' => 'required',
                'driver' => 'required',
                'owner' => 'required'
            ]);
            $model = new vehiculo();
            $model->plate = $request->plate;
            $model->id_brand = $request->brand;
            $model->id_type = $request->type;
            $model->color = $request->color;
            $model->id_driver = $request->driver;
            $model->id_owner = $request->owner;
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
            $resultado = vehiculo::select('vehiculos.plate', 'vehiculos.color', 'brands.name as brand_name', 'types.name as type_name', 'drivers.first_name as driver_first_name', 'drivers.middle_name as driver_middle_name', 'drivers.last_name as driver_last_name', 'drivers.id_driver', 'owners.first_name as owner_first_name', 'owners.middle_name as owner_middle_name', 'owners.last_name as owner_last_name', 'owners.id_owner')
                ->join('brands', 'vehiculos.id_brand', '=', 'brands.id_brand')
                ->join('types', 'vehiculos.id_type', '=', 'types.id_type')
                ->join('drivers', 'vehiculos.id_driver', '=', 'drivers.id_driver')
                ->join('owners', 'vehiculos.id_owner', '=', 'owners.id_owner')
                ->get();

            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $resultado, 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }


    public function getBrands()
    {

        try {
            $brands = brand::all();

            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $brands, 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
    public function getCities()
    {

        try {
            $cities = city::all();

            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $cities, 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
}
