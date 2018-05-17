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
            $table->decimal("resp_rate");
            $table->string("resp_effort");
            $table->string("o2_liters");
            $table->decimal("spo2");
            $table->decimal("heart_rate");
            $table->decimal("systolic_bp");
            $table->unsignedInteger("nurse_id")->references("id")->on("nurses");
            $table->unsignedInteger("patient_id")->references("id")->on("patients");
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
