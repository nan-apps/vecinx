<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRouteToStops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('neighbours', function (Blueprint $table) {
            $table->dropForeign(['route_id']);
            $table->dropColumn(['route_id']);
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('route_id')->nullable()->after('hood_id')->constrained('routes');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->unique('address');
            $table->unique(['lat', 'lng']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
