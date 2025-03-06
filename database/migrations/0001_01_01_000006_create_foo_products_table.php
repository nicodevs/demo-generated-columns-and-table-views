<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foo_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('base_price');
            $table->decimal('tax_rate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foo_products');
    }
};
