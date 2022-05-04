<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblsinhvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblsinhvien', function (Blueprint $table) {
            $table->string('MaSV', 20)->primary();
            $table->string('HoTen', 50);
            $table->date('NgaySinh');
            $table->tinyInteger('GioiTinh');
            $table->string('QueQuan', 100);
            $table->string('DienThoai', 10);
            $table->string('Lop', 20);
            $table->integer('Khoa');
            $table->string('MaHopDong', 10);
            $table->string('MaPhong', 10);
            $table->integer('User_Id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblsinhvien');
    }
}
