<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //
    public function index(Request $request){
        $flightNumber = $request->query('number');
        $departureCity = $request->query('departure_city');
        $arrivalCity = $request->query('arrival_city');
        $departureTime = $request->query('departure_time');
        $arrivalTime = $request->query('arrival_time');
        $sortField = $request->query('sort_field', 'departure_time'); 
        $sortOrder = $request->query('sort_order', 'asc'); 


        $query = Flight::query();

        if ($flightNumber) {
            $query->where('number', 'like', "$flightNumber");
        }

        if ($departureCity) {
            $query->where('departure_city', 'like', "$departureCity");
        }

        if ($arrivalCity) {
            $query->where('arrival_city', 'like', "$arrivalCity");
        }

        if ($departureTime) {
            $query->whereDate('departure_time', $departureTime);
        }

        if ($arrivalTime) {
            $query->whereDate('arrival_time', $arrivalTime);
        }

        $query->orderBy($sortField, $sortOrder);

        $flights = $query->paginate(15); 

        return response()->json($flights);
    }
}
