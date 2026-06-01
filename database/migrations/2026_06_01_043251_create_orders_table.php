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
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('customer_name');
        $table->string('jewelry_item');
        $table->integer('quantity');
        $table->decimal('price', 10, 2);
        $table->decimal('total_price', 10, 2);
        $table->string('status', 50)->default('Pending');
        
        // This explicitly creates the precise order_date column your query is sorting by!
        $table->timestamp('order_date')->useCurrent();
        
        $table->timestamps();

        // Foreign key relation
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
