<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblhopdongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblhopdong', function (Blueprint $table) {
            $table->string('MaHopDong', 10)->primary();
            $table->date('NgayDangKy');
            $table->date('NgayHetHan');
            $table->date('NgayKy');
            $table->string('ChuThich', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblhopdong');
    }
}
