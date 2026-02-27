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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('template_surat')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_surat')->cascadeOnDelete();
            $table->string('nomor_surat')->unique();
            $table->json('data_isian'); // hasil form dinamis
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keluar', function (Blueprint $table) {
            //
        });
    }
};
