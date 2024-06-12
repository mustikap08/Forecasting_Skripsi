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
        Schema::create('uji', function (Blueprint $table) {
            $table->id();
            $table->date('month')->nullable();
            $table->float('x')->nullable();
            $table->float('sales');
            $table->float('sales_forecast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji');
    }
};
