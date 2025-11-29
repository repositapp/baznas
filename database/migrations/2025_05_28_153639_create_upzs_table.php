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
        Schema::create('upzs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategoriupz_id')->index()->constrained();
            $table->string('nama_upz');
            $table->string('npwp')->nullable();
            $table->string('no_pengukuhan');
            $table->date('tgl_pengukuhan');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('fax');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upzs');
    }
};
