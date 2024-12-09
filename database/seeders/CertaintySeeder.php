<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertaintySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certainties')->insert([
            'label' => 'Tidak',
            'score' => 0,
        ]);
        DB::table('certainties')->insert([
            'label' => 'Mungkin',
            'score' => 0.2,
        ]);
        DB::table('certainties')->insert([
            'label' => 'Kemungkinkan Besar',
            'score' => 0.4,
        ]);
        DB::table('certainties')->insert([
            'label' => 'Hampir Pasti',
            'score' => 0.6,
        ]);
        DB::table('certainties')->insert([
            'label' => 'Pasti',
            'score' => 0.8,
        ]);
    }
}
