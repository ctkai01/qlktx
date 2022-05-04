<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblnhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblnhanvien', function (Blueprint $table) {
            $table->string('MaNV', 11)->primary();
            $table->string('HoTen', 50);
            $table->date('NgaySinh');
            $table->tinyInteger('GioiTinh');
            $table->string('QueQuan', 100);
            $table->string('DienThoai', 10);
            $table->integer('User_Id')->unsigned();
            $table->date('NgayLam');
            $table->string('CaLam', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblnhanvien');
    }
}
