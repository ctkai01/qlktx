<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblphieudangkyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblphieudangky', function (Blueprint $table) {
            $table->string('MaDangKy', 10)->primary();
            $table->string('MaSV', 20);
            $table->date('NgayDangKy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblphieudangky');
    }
}
