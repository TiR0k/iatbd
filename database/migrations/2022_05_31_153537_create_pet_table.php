<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->foreign("type")->references("type")->on("type_of_pet");
            $table->foreignId("user_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pet', function (Blueprint $table){
           $table->dropForeign("pet_type_foreign");
           $table->dropForeign("pet_user_id_foreign");
        });

        Schema::dropIfExists('pet');
    }
}
