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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_id')->index()->constrained();
            $table->foreignId('amil_id')->index()->constrained();
            $table->foreignId('mustahik_id')->index()->constrained();
            $table->foreignId('zakat_id')->index()->constrained();
            $table->string('kode_penyaluran')->unique();
            $table->date('tgl_penyaluran');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};
