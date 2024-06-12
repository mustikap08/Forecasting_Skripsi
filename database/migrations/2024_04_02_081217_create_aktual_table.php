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
        Schema::create('aktual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id'); // Kolom kategori_id sebagai foreign key
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->String('bulan');
            $table->String('financial_year');
            $table->String('chain');
            $table->String('subrub');
            // $table->String('state');
            // $table->String('country');
            $table->float('sales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktual');
    }
};
