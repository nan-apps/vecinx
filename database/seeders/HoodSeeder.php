<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('hoods')->insert(
        [
          ['name' => 'Agronomía'],
          ['name' => 'Almagro'],
          ['name' => 'Balvanera'],
          ['name' => 'Barracas'],
          ['name' => 'Belgrano'],
          ['name' => 'Boedo'],
          ['name' => 'Caballito'],
          ['name' => 'Chacarita'],
          ['name' => 'Coghlan'],
          ['name' => 'Colegiales'],
          ['name' => 'Constitución'],
          ['name' => 'Flores'],
          ['name' => 'Floresta'],
          ['name' => 'La Boca'],
          ['name' => 'La Paternal'],
          ['name' => 'Liniers'],
          ['name' => 'Mataderos'],
          ['name' => 'Montserrat'],
          ['name' => 'Monte Castro'],
          ['name' => 'Nueva Pompeya'],
          ['name' => 'Núñez'],
          ['name' => 'Palermo'],
          ['name' => 'Parque Avellaneda'],
          ['name' => 'Parque Chacabuco'],
          ['name' => 'Parque Chas'],
          ['name' => 'Parque Patricios'],
          ['name' => 'Puerto Madero'],
          ['name' => 'Recoleta'],
          ['name' => 'Retiro'],
          ['name' => 'Saavedra'],
          ['name' => 'San Cristóbal'],
          ['name' => 'San Nicolás'],
          ['name' => 'San Telmo'],
          ['name' => 'Vélez Sarsfield'],
          ['name' => 'Versalles'],
          ['name' => 'Villa Crespo'],
          ['name' => 'Villa del Parque'],
          ['name' => 'Villa Devoto'],
          ['name' => 'Villa Gral. Mitre'],
          ['name' => 'Villa Lugano'],
          ['name' => 'Villa Luro'],
          ['name' => 'Villa Ortúzar'],
          ['name' => 'Villa Pueyrredón'],
          ['name' => 'Villa Real'],
          ['name' => 'Villa Riachuelo'],
          ['name' => 'Villa Santa Rita'],
          ['name' => 'Villa Soldati'],
          ['name' => 'Villa Urquiza']

        ]);
    }
  }
