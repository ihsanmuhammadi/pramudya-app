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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_surat'); // dari surat jalan
            $table->foreignUuid('order_id')->constrained()->onDelete('cascade'); // relasi ke orders
            $table->date('tanggal');
            $table->string('penerima');
            $table->enum('status', ['Menunggu', 'Perjalanan', 'Diterima'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
