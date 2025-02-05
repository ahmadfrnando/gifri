<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('ref_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
        });

        DB::table("ref_jabatan")->insert([
            ["id" => 1, "nama_jabatan" => "Guru"],
            ["id" => 2, "nama_jabatan" => "Kepala Sekolah"],
            ["id" => 3, "nama_jabatan" => "Tata Usaha"],
            ["id" => 4, "nama_jabatan" => "Perpustakaan"],
            ["id" => 5, "nama_jabatan" => "Wali Kelas"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_jabatan');
    }
};
