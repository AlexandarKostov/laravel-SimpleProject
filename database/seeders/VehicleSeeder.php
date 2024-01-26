<?php

namespace Database\Seeders;


use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 30; $i++) {
            DB::table('vehicle_models')->insert([
                'brand' => faker()->vehicleBrand(),
                'model' => faker()->vehicleModel(),
                'plate_number' => faker()->vehicleRegistration(),
                'insurance_date' => faker()->biasedNumber(),
            ]);
        }
    }
}
