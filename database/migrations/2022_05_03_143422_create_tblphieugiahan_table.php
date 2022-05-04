<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblphieugiahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblphieugiahan', function (Blueprint $table) {
            $table->string('MaGiaHan', 10)->primary();
            $table->string('MaSV', 20);
            $table->date('ThoiGianGiaHan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblphieugiahan');
    }
}
