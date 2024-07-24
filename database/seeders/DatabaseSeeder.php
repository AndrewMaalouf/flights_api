<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Database\Seeder;
use Mockery\Generator\StringManipulation\Pass\Pass;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([PassengerSeeder::class, FlightSeeder::class, RoleSeeder::class]);

        // $this->call(RoleSeeder::class);
       
        Flight::factory()->count(20)->create();
        Passenger::factory()->count(30)->create();

        $flights = Flight::all();
        Passenger::all()->each(function ($passenger) use ($flights) {
            $passenger->flights()->attach(
                $flights->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
