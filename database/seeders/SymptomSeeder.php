<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symptoms')->insert([
            'name' => 'Kulit Kekuningan',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Demam Ringan',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Bercak Kulit',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Lelah',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Nyeri Perut',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Selera Makan Hilang',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Mual - Muntah',
        ]);
        DB::table('symptoms')->insert([
            'name' => 'Nyeri Sendi',
        ]);
    }
}
