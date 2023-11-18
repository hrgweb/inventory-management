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
            $table->string('name')->index();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnDelete();

            $table->decimal('cost_price', 15, 2);
            $table->decimal('selling_price', 15, 2);
            $table->unsignedBigInteger('stock_qty');
            $table->unsignedBigInteger('reorder_level');
            $table->string('barcode')->nullable()->index();
            $table->decimal('tax_rate', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->boolean('is_available')->default(1);
            $table->string('product_image_url')->nullable();
            $table->decimal('weight', 15, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->text('notes')->nullable();
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
