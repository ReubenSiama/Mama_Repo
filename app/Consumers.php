<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class consumers extends Model
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeId')->unique();
            $table->string('employeeId')->unique();
            $table->integer('department_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('category');
            $table->integer('group_id')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
