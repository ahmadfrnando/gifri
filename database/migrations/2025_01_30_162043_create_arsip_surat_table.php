<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('arsip_surat');
        
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->string('file_surat');
            $table->date('tanggal_surat');
            $table->string('pihak_terkait');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arsip_surat');
    }
};
