<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
use Spatie\QueryBuilder\QueryBuilder;


class PassengerController extends Controller
{
    public function index()
    {
        $passengers = QueryBuilder::for(Passenger::class)
        ->allowedFilters([
            'id',
            'first_name',
            'last_name',
            'email',
            'dob',
            'passport_expiry_date'
        ])
        ->allowedSorts([
            'id'
        ])
        ->paginate(10)
        ->get();

    return response()->json($passengers);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers',
            'password' => 'required|string|min:8',
            'dob' => 'required|date',
            'passport_expiry_date' => 'required|date',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $passenger = Passenger::create($validatedData);

        return response()->json($passenger, 201); 
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:passengers,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'dob' => 'sometimes|date',
            'passport_expiry_date' => 'sometimes|date',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $passenger = Passenger::findOrFail($id);
        $passenger->update($validatedData);

        return response()->json($passenger);
    }

    public function destroy($id){
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return response()->json(null, 204);
    }

    public function show($id){
        $passenger = Passenger::findOrFail($id);

        return response()->json($passenger);
    }

    public function getPassengerByFlightId(Request $request, $flightId){
        $flight = Flight::findOrFail($flightId);
        $passengers = $flight->passengers()->paginate(15);

        return response()->json($passengers);
    }
}
