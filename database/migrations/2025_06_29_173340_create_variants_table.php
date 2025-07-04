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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->string("sku")->nullable();
            $table->decimal("price_modifier", 10, 2)->default(0);
            $table->integer("stock")->default(0);
            $table->decimal('weight_modifier', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
