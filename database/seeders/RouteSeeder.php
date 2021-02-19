<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
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
          'color' => 'danger',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Recorrido 2',
          'key' => 'route-2',
          'color' => 'secondary',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Recorrido 3',
          'key' => 'route-3',
          'color' => 'success',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Recorrido 4',
          'key' => 'route-4',
          'color' => 'info',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Recorrido 5',
          'key' => 'route-5',
          'color' => 'primary',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],

      ]);
    }
  }
