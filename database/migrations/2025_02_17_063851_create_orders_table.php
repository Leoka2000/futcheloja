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
            $table->uuid('id');
            $table->string('name')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->string('status')->nullable();
            $table->string('size')->nullable();
            $table->string('tracking_code')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->string('session_id')->nullable();
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
