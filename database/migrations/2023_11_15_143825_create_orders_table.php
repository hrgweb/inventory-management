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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_transaction_session')->index();

            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();

            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

            // Products
            $table->string('product_name')->nullable()->index();
            $table->string('product_description')->nullable();
            $table->decimal('selling_price', 15, 2);
            $table->integer('qty')->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();

            $table->timestamp('order_date')->nullable();
            $table->timestamp('ship_date')->nullable();
            $table->text('ship_address')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_region')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('ship_postal_code')->nullable();
            $table->string('order_status')->nullable();   // (e.g., pending, processing, shipped, delivered).
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_method');   // (e.g., credit card, PayPal).
            $table->string('payment_status');   // (e.g., paid, pending, declined).
            $table->string('promotion_code')->nullable();   // (e.g., paid, pending, declined).
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
