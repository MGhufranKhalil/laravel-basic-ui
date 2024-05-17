<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('country_id');
            $table->string('zip_code');
            $table->string('country_code');
            $table->string('phone');
            $table->string('email');
            $table->string('image');
            $table->string('job');
            $table->enum('status',['active','inactive']);
            $table->string('duties');
            $table->date('hiring_date');
            $table->date('leaving_date');
            $table->string('associates');
            $table->timestamps();
        });

        Schema::create('employee_incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->string('location');
            $table->date('date');
            $table->time('time');
            $table->text('details');
            $table->timestamps();
        });

        Schema::create('employee_incident_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('emp_incident_id');
            $table->string('image');
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
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_incidents');
        Schema::dropIfExists('employee_incident_images');
    }
};
