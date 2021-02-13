<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('members')->insert(
      [
        [
          'name' => "Julia Mana",
          'email' => 'juliamana@example.com',
          'address' => "Calle mana 123",
          'phone' => "45612345",
          'role_id' => 1,
        ],
        [
          'name' => "Pepe Silo",
          'email' => 'pepesilo@example.com',
          'address' => "Calle silo 123",
          'phone' => "45678132",
          'role_id' => 2
        ],
        [
          'name' => "Luci Seil",
          'email' => 'luseil@example.com',
          'address' => "Calle seil 123",
          'phone' => "66989689",
          'role_id' => 3
        ]

      ]);
    }
  }
