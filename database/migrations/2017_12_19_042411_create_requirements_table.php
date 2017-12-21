<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('main_category');
            $table->string('sub_category')->nullable();
            $table->string('material_spec');
            $table->string('referral_image1')->nullable();
            $table->string('referral_image2')->nullable();
            $table->date('requirement_date');
            $table->string('measurement_unit');
            $table->string('unit_price');
            $table->string('quantity');
            $table->string('total');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('requirements');
    }
}
