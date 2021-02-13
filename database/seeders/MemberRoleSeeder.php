<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('member_roles')->insert(
      [
        [
          'name' => "Cocina",
          'key' => 'cook'
        ],
        [
          'name' => "Conduce",
          'key' => 'drive'
        ],
        [
          'name' => "Recorre",
          'key' => 'walk'
        ],
        

      ]);
    }
  }
