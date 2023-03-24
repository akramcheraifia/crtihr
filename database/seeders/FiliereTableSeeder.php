<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filieres')->insert([
            [
               'nom' => 'chercheurs permanents',
            ],
            [
                'nom' => 'developpment technologique',
            ],
            [
                'nom' => 'ingenierie',
            ],
            [
                'nom' => 'information scientifique et technologique',
            ],
            [
                'nom' => 'administration de la recherche',
            ],
            [
                'nom' => 'entretien et service',
            ],

        ]);
    }
}
