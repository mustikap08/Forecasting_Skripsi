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
        Schema::create('futurecast', function (Blueprint $table) {
            $table->id();
            $table->date('month');
            $table->float('x')->nullable();
            $table->float('sales')->nullable();
            $table->float('sales_forecast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futurecast');
    }
};
