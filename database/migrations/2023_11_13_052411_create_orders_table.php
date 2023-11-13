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
            $table->integer('user_id')->nullable();
            $table->string('order_id',25)->nullable();
            $table->string('c_name')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_country')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_address')->nullable();
            $table->string('c_email')->nullable();
            $table->string('c_zipcode')->nullable();
            $table->string('date',20)->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('main_balance')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('shipping_charge',5)->nullable();
            $table->string('status')->nullable()->default('0');
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
