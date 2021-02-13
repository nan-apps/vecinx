<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeighboursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neighbours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_number')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->text('address_notes')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('enable')->default(1);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });

            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->string('address');
                $table->decimal('lat', 10, 6);
                $table->decimal('lng', 10, 6);
                $table->text('address_notes')->nullable();
                $table->foreignId('neighbour_id')->constrained('neighbours');
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });


            Schema::create('notes', function (Blueprint $table) {
                $table->id();
                $table->string('body');
                $table->foreignId('neighbour_id')->constrained('neighbours');
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at', $precision = 0);
            });

    Schema::create('tags', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('color');
        $table->string('key')->unique();
    });

        Schema::create('hoods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('key')->unique()->nullable();
        });

        Schema::table('neighbours', function (Blueprint $table) {
            $table->foreignId('hood_id')->after('address_notes')->constrained('hoods');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('hood_id')->after('address_notes')->constrained('hoods');
        });

        Schema::table('hoods', function (Blueprint $table) {
            $table->boolean('enable')->default(0);
        });

        Schema::table('notes', function (Blueprint $table) {
          $table->foreignId('tag_id')->after('neighbour_id')->constrained('tags');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('neighbours');
        Schema::dropIfExists('hoods');
    }
}
