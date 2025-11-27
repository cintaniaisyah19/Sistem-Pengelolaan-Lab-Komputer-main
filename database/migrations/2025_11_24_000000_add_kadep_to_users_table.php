<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrasi ini tidak lagi diperlukan karena peran 'kadep'
        // sudah dipastikan ada di migrasi sebelumnya. Dibiarkan kosong
        // untuk menjaga histori migrasi.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada aksi yang perlu dibatalkan.
    }
};
