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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_id')->index()->constrained();
            $table->foreignId('amil_id')->index()->constrained();
            $table->foreignId('muzaki_id')->index()->constrained();
            $table->foreignId('zakat_id')->index()->constrained();
            $table->foreignId('akunbank_id')->nullable()->constrained()->nullOnDelete();
            $table->string('kode_pembayaran')->unique();
            $table->date('tgl_bayar');
            $table->string('jenis_pembayaran');
            $table->string('metode_bayar');
            $table->string('nilai_ukur');
            $table->string('jumlah_keluarga');
            $table->string('total');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
