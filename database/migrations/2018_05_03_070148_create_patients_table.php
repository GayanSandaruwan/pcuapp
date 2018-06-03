<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("name");
            $table->string('address')->nullable();
            $table->date("birthday");
            $table->string('gender');
            $table->string("area")->nullable();
            $table->string("source")->nullable();
            $table->string("triage")->nullable();


//            $table->integer('age')->nullable();
//            $table->string("admission_no");
            $table->string("contact_no")->nullable();
            $table->unsignedInteger("nurse_id");        //->references("id")->on("nurses");

            $table->foreign("nurse_id")->references("id")->on("nurses");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
