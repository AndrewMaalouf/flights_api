<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //
    public function index(){
        $flights = Flight::get();
    
        return response()->json($flights);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|string|max:255|unique:flights',
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
        ]);

        $flight = Flight::create($validatedData);

        return response()->json($flight, 201); 
    }

    public function show($id){
        $flight = Flight::findOrFail($id);

        return response()->json($flight);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'number' => 'sometimes|string|max:255|unique:flights,number,' . $id,
            'departure_city' => 'sometimes|string|max:255',
            'arrival_city' => 'sometimes|string|max:255',
            'departure_time' => 'sometimes|date',
            'arrival_time' => 'sometimes|date',
        ]);

        $flight = Flight::findOrFail($id);
        $flight->update($validatedData);

        return response()->json($flight);
    }

    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return response()->json(null, 204); 
    }
    
}
