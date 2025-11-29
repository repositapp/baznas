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
        Schema::create('muzakis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_id')->index()->constrained();
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin');
            $table->string('pekerjaan');
            $table->string('nip')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->text('alamat_rumah');
            $table->string('telepon');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muzakis');
    }
};
