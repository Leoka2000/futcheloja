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
        Schema::create('refund_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_hashed_id');
            $table->string('email')->nullable();
            $table->text('refund_reason')->nullable();
            $table->string('refund_pix_key')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_orders');
    }
};
