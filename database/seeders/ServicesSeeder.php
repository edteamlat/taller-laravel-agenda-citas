<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Limpieza facial',
            'duration' => 90,
        ]);
        Service::create([
            'name' => 'Corte de cabello',
            'duration' => 30,
        ]);
        Service::create([
            'name' => 'Tinturado de cabello',
            'duration' => 180,
        ]);
        Service::create([
            'name' => 'Maquillaje',
            'duration' => 40,
        ]);
    }
}
