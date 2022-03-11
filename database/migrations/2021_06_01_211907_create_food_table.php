<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('soal');
            $table->string('gambar_soal');
            $table->string('a');
            $table->string('a_gambar');
            $table->string('b');
            $table->longText('b_gambar');
            $table->longText('c');
            $table->string('c_gambar');
            $table->integer('cat_id');
            $table->string('d');
            $table->string('d_gambar');
            $table->string('kunci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}
