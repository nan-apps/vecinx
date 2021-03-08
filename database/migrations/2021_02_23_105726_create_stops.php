<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['neighbour_id']);
            $table->dropColumn(['neighbour_id']);
        });

        Schema::table('neighbours', function (Blueprint $table) {
            $table->dropForeign(['hood_id']);
            $table->dropColumn(['hood_id']);
            $table->dropColumn(['lat', 'lng', 'address', 'hood_id']);
        });

        Schema::table('neighbours', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->after('route_id')->constrained('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('neighbour_id')->constrained('neighbours');
        });

        Schema::table('neighbours', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });
    }
}
