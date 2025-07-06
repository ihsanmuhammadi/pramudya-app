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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_po');
            $table->date('tanggal');
            $table->string('company');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('email');
            $table->string('fax')->nullable();
            $table->string('pic');
            $table->decimal('total_semua_barang', 15,2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
