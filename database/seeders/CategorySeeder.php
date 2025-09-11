<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Register initial data
        DB::table('category')->insert(
            array(
              'description' => 'Mercado'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Ropa'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Tecnología'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Mascotas'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Ferretería'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Iluminación'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Construccion'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Maquinaria'
            )
        );
        DB::table('category')->insert(
            array(
              'description' => 'Muebles'
            )
        );
    }
}
