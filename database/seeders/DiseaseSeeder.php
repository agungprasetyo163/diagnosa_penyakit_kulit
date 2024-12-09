<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diseases')->insert([
            'name' => 'Hepatitis',
        ]);
        DB::table('diseases')->insert([
            'name' => 'Demam Berdarah',
        ]);
    }
}
