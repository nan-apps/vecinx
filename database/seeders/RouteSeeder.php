<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('routes')->insert(
      [
        [
          'name' => 'Recorrido 1',
          'key' => 'route-1',
          'color' => 'danger'
        ],
        [
          'name' => 'Recorrido 2',
          'key' => 'route-2',
          'color' => 'secondary'
        ],
        [
          'name' => 'Recorrido 3',
          'key' => 'route-3',
          'color' => 'success'
        ],
        [
          'name' => 'Recorrido 4',
          'key' => 'route-4',
          'color' => 'info'
        ],
        [
          'name' => 'Recorrido 5',
          'key' => 'route-5',
          'color' => 'primary'
        ],

      ]);
    }
  }
