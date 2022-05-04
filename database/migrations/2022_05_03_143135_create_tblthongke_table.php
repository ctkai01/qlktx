<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblthongkeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblthongke', function (Blueprint $table) {
            $table->string('MaThongKe', 10)->primary();
            $table->string('TenThongKe', 50);
            $table->integer('TongThuNhap');
            $table->date('ThoiGian');
            $table->string('ChuThich', 200)->nullable();
            $table->string('MaNV', 11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblthongke');
    }
}
