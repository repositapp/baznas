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
        Schema::create('bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_id')->index()->constrained();
            $table->foreignId('amil_id')->index()->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->date('range_start');
            $table->date('range_end');
            $table->integer('jumlah_donasi');
            $table->text('image')->nullable();
            $table->integer('views')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bansos');
    }
};
