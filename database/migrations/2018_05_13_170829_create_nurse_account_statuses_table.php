<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNurseAccountStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_account_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("old_status");
            $table->string("new_status");
            $table->unsignedInteger("admin_id");        //->references("id")->on("admins");
            $table->unsignedInteger("nurse_id");        //->references("id")->on("nurses");
            $table->timestamps();

            $table->foreign("admin_id")->references("id")->on("admins");
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
        Schema::dropIfExists('nurse_account_statuses');
    }
}
