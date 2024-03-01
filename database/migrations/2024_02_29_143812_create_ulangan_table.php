<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulangan', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_id');
            $table->integer('kelas_id');
            $table->integer('guru_id');
            $table->integer('mapel_id');
            $table->string('ulha_1', 5)->nullable();
            $table->string('ulha_2', 5)->nullable();
            $table->string('uts', 5)->nullable();
            $table->string('ulha_3', 5)->nullable();
            $table->string('uas', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulangan');
    }
};
