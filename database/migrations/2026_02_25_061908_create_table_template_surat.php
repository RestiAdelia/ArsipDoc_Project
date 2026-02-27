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
        Schema::create('template_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_surat');
            $table->string('nama_template');
            $table->longText('isi_template');
            $table->json('field_json')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_surat', function (Blueprint $table) {
            //
        });
    }
};
