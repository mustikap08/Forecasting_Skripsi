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
        Schema::create('rumus', function (Blueprint $table) {
            $table->id();
            $table->float('n');
            $table->float('ey');
            $table->float('ex');
            $table->float('exy');
            $table->float('ex2');
            $table->float('ex_square');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumus');
    }
};
