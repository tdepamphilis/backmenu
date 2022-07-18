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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->integer('orden');
            $table->boolean('activo')->default(true);
            $table->timestamps();

        });


        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 100)->nullable();
            $table->boolean('es_veggie')->default(false);
            $table->boolean('es_vegan')->default(false);
            $table->float('precio', 7, 2);
            $table->string('imagen', 250);
            $table->integer('orden');
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
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
        Schema::dropIfExists('items');
        Schema::dropIfExists('categorias');
    }
};
