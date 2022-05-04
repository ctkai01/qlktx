<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblchitiethoadonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblchitiethoadon', function (Blueprint $table) {
            $table->string('MaHoaDon', 10)->primary();
            $table->integer('TienPhong');
            $table->integer('TienDien');
            $table->integer('TienNuoc');
            $table->integer('TienPhatSinh');
            $table->string('GhiChu', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblchitiethoadon');
    }
}
