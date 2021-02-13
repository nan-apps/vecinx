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
      DB::table('tags')->insert(
      [
        [
          'name' => 'Salud',
          'key' => 'health',
          'color' => '#007bff'
        ],
        [
          'name' => 'Trámites',
          'key' => 'formalities',
          'color' => '#28a745'
        ],
        [
          'name' => 'Laboral',
          'key' => 'job',
          'color' => '#ffc107'
        ],
        [
          'name' => 'Educación',
          'key' => 'edication',
          'color' => '#17a2b8'
        ]

      ]);
    }
  }
