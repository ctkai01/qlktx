<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblphieukyluatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblphieukyluat', function (Blueprint $table) {
            $table->string('MaKyLuat', 10)->primary();
            $table->string('MaSV', 20);
            $table->string('HinhThucViPham', 50);
            $table->date('ThoiGianViPham');
            $table->string('HinhThucKyLuat', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblphieukyluat');
    }
}
