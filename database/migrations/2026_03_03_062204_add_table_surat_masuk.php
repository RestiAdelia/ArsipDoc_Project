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
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->enum('status_arsip', ['nonaktif', 'aktif'])
                  ->default('nonaktif')
                  ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('surat_masuk', function (Blueprint $table) {
            $table->enum('status_arsip', ['nonaktif', 'aktif'])
                  ->default('nonaktif')
                  ->after('status'); 
        });
    }
};
