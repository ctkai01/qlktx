<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hoadonsinhvien', function (Blueprint $table) {
            $table->id();
            $table->string('MaSV', 20);
            $table->date('ThoiGian');
            $table->integer('TienPhong');
            $table->boolean('DaThanhToan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hoadonsinhvien');
    }
}
