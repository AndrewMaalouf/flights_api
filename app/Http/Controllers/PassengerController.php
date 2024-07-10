<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(Request $request)
    {
        $firstName = $request->query('first_name');
        $lastName = $request->query('last_name');
        $email = $request->query('email');
        $sortField = $request->query('sort_field', 'first_name'); 
        $sortOrder = $request->query('sort_order', 'asc'); 

        $query = Passenger::query();

        if ($firstName) {
            $query->where('first_name', 'like', "$firstName");
        }
        if ($lastName) {
            $query->where('last_name', 'like', "$lastName");
        }
        if ($email) {
            $query->where('email', 'like', "$email");
        }

        $query->orderBy($sortField, $sortOrder);
     
        $passengers = $query->paginate(15);

        return response()->json($passengers);
    }
}
