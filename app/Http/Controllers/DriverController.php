<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\driver;
use Illuminate\Database\QueryException;
use SebastianBergmann\CodeCoverage\Driver\Driver as DriverDriver;

class DriverController extends Controller
{
    //
    public function save(Request $request)
    {

        try {

            $request->validate([
                'ccnumber' => 'required',
                'name' => 'required',
                'lastName' => 'required',
                'address' => 'required',
                'phoneNumber' => 'required',
                'city' => 'required'
            ]);

            $model = new driver();
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
            $drivers = driver::all();

            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $drivers, 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
    public function getDriver($id)
    {
        try {
            $resultado = Driver::select('drivers.id_driver', 'drivers.number_cc', 'drivers.first_name', 'drivers.middle_name', 'drivers.last_name', 'drivers.address', 'drivers.phone_number', 'cities.name as city')
                ->join('cities', 'drivers.id_city', '=', 'cities.id_city')
                ->where('drivers.id_driver', '=', $id)
                ->get();

            // $driver = Driver::where('id_driver', $id)->first();
            // Si llegamos aquí, la consulta se ejecutó con éxito
            return response()->json(['data' => $resultado[0], 'estado' => 'exito']);
        } catch (\Exception $e) {
            // Captura cualquier excepción genérica que pueda ocurrir
            return response()->json(['mensaje' => $e->getMessage(), 'estado' => 'error'], 500);
        }
    }
 
}
