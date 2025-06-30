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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->decimal("price", 10, 2);
            $table->decimal("cost", 10, 2)->nullable();
            $table->decimal("weight", 8, 2)->nullable();
            $table->foreignId("provider_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("category_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("tax_id")->nullable()->constrained("taxes")->nullOnDelete();
            $table->string("image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
