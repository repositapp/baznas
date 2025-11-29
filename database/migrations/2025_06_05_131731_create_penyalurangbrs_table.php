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
        Schema::create('penyalurangbrs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyaluran');
            $table->string('nama_gambar');
            $table->text('gambar');
            $table->timestamps();

            $table->foreign('kode_penyaluran')
                ->references('kode_penyaluran')
                ->on('penyalurans')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurangbrs');
    }
};
