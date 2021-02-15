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
          'color' => 'primary'
        ],
        [
          'name' => 'Trámites',
          'key' => 'formalities',
          'color' => 'secondary'
        ],
        [
          'name' => 'Laboral',
          'key' => 'job',
          'color' => 'success'
        ],
        [
          'name' => 'Educación',
          'key' => 'edication',
          'color' => 'info'
        ]

      ]);
    }
  }
