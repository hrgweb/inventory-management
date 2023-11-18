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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('order_transaction_session')->index();

            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();

            $table->unsignedBigInteger('cashier_id');
            $table->foreign('cashier_id')->references('id')->on('cashiers')->cascadeOnDelete();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();

            $table->string('payment_method');
            $table->decimal('discount_applied', 15, 2)->nullable();
            $table->decimal('tax_amount', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->string('transaction_status')->nullable();    // (e.g., completed, voided, pending)
            $table->text('notes')->nullable();
            $table->string('invoice_number')->nullable();
            $table->decimal('refund_amount', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
