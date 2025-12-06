<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table');     // contoh: posyandu, jadwal_posyandu, berita, dll
            $table->unsignedBigInteger('ref_id');  // ID dari tabel referensi
            $table->string('file_name');     // hanya simpan nama file
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // tidak ada foreign key sesuai permintaan
            $table->index(['ref_table', 'ref_id']); // untuk query lebih cepat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
