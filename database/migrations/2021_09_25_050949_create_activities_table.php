<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('trackid',32)->unique();
            $table->string('title');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->dateTime('start_at')->nullable(false);
            $table->integer('duration')->nullable(true); //seconds
            $table->float('distance')->nullable(true); //meters
            $table->float('avrspeed')->nullable(true); // m/s
            $table->float('avrpace')->nullable(true);   // s/km
            $table->integer('minaltitude')->nullable(true);
            $table->integer('maxaltitude')->nullable(true);
            $table->integer('elevationgain')->nullable(true);
            $table->integer('elevationloss')->nullable(true);
            $table->dateTime('started_at')->nullable(true);
            $table->dateTime('finished_at')->nullable(true);
            $table->string('creator',150);
            $table->longText('gpx');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
