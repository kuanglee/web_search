<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_news', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('TieuDe')->nullable();
            $table->string('TieuDeKhongDau')->nullable();
            $table->string('TomTat')->nullable();
            $table->longText('NoiDung')->nullable();
            $table->integer('Hinh')->nullable();
            $table->integer('SoLuotXem')->nullable();
            $table->integer('idLoaiTin')->unsigned();
            $table->foreign('idLoaiTin')->references('id')->on('loaitin');
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
        Schema::dropIfExists('type_news');
    }
}
