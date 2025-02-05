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
        Schema::create('ref_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
        });

        DB::table("ref_mapel")->insert([
            ["id" => 1, "nama_mapel" => "Bahasa Indonesia"],
            ["id" => 2, "nama_mapel" => "Bahasa Inggris"],
            ["id" => 3, "nama_mapel" => "Matematika"],
            ["id" => 4, "nama_mapel" => "IPA"],
            ["id" => 5, "nama_mapel" => "IPS"],
            ["id" => 6, "nama_mapel" => "PKN"],
            ["id" => 7, "nama_mapel" => "Penjaskes"],
            ["id" => 8, "nama_mapel" => "Agama Islam"],
            ["id" => 9, "nama_mapel" => "BK"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_mapel');
    }
};
