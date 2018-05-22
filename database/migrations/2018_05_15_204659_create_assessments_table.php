<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer("resp_rate");
            $table->string("resp_effort");
            $table->string("o2_liters");
            $table->integer("spo2");
            $table->integer("heart_rate");
            $table->integer("systolic_bp");
            $table->string("avpu");
            $table->string('crft');
            $table->unsignedInteger("nurse_id")->references("id")->on("nurses");
            $table->unsignedInteger("patient_id")->references("id")->on("patients");
            $table->unsignedInteger("admission_id")->references("id")->on("admissions.");
            $table->string("complain");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
