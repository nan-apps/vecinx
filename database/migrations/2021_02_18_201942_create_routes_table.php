<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('key')->unique();
            $table->string('color');
            $table->boolean('enable')->default(1);
            $table->timestamps();
        });

        Schema::table('neighbours', function (Blueprint $table) {
          $table->foreignId('route_id')->nullable()->after('birthdate')->constrained('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
        Schema::table('neighbours', function (Blueprint $table) {
            $table->dropColumn('route_id');
        });
    }
}
