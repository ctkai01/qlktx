<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('tblthongtinphong', function (Blueprint $table) {
            $table->id();
            $table->string('MaPhong', 10)->unique();
            $table->string('TinhTrang', 20);
            $table->integer('LoaiPhong');
            $table->integer('GiaPhong');
            $table->integer('SoNguoi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblthongtinphong');
    }
}
