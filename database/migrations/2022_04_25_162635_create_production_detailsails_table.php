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
        Schema::create('production_detailsails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->string('Depolama_Alani');
            $table->string("Ekran_Boyutu");
            $table->string("RAM");
            $table->string("Yazar");
            $table->string("Çevirmen");
            $table->string("Sayfa_Sayisi");
            $table->string("Baski_Sayisi");
            $table->string("Dil");
            $table->string("İlk_Baski_Yili");
            

            $table->foreign("product_id")->references("id")->on("products");
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
        Schema::dropIfExists('production_detailsails');
    }
};
