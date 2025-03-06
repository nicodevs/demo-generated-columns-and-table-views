<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bar_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('base_price');
            $table->decimal('tax_rate');
            $table->decimal('final_price')->storedAs('base_price * (1 + tax_rate * 0.01)');
            $table->timestamps();

            $table->index('final_price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bar_products');
    }
};
