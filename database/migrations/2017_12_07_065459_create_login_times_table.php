<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_times', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id');
            $table->string('logindate');
            $table->string('loginTime');
            $table->string('firstListingTime')->nullable();
            $table->string('allocatedWard')->nullable();
            $table->string('morningRemarks')->nullable();
            $table->string('morningMeter')->nullable();
            $table->string('morningData')->nullable();
            $table->string('afternoonMeter')->nullable();
            $table->string('afternoonData')->nullable();
            $table->string('noOfProjectsListedInMorning')->nullable();
            $table->string('afternoonRemarks')->nullable();
            $table->string('eveningMeter')->nullable();
            $table->string('eveningData')->nullable();
            $table->string('TotalProjectsListed')->nullable();
            $table->string('lastListingTime')->nullable();
            $table->string('logoutTime')->nullable();
            $table->string('eveningRemarks')->nullable();
            $table->string('AmGrade')->nullable();
            $table->string('AmRemarks')->nullable();
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
        Schema::dropIfExists('login_times');
    }
}
