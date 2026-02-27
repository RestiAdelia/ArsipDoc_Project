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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();   
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // pengirim
            $table->string('nomor_surat')->unique();
            $table->string('asal_surat');
            $table->string('instansi'); // nama instansi pengirim
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('file')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // status approval

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};