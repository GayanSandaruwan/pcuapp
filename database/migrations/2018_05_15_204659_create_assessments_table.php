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
            $table->integer("resp_rate")->nullable();
            $table->string("resp_effort")->nullable();
            $table->string("o2_liters")->nullable();
            $table->integer("spo2")->nullable();
            $table->integer("heart_rate")->nullable();
            $table->integer("systolic_bp")->nullable();
            $table->string("avpu")->nullable();
            $table->string('crft')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('temperature')->nullable();
            $table->unsignedInteger("nurse_id")->references("id")->on("nurses");
            $table->unsignedInteger("patient_id")->references("id")->on("patients");
            $table->unsignedInteger("admission_id")->references("id")->on("admissions.");
            $table->string("complain")->nullable();
            $table->string("discharge")->default("false");
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
