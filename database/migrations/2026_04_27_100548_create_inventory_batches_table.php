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
        Schema::create('inventory_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();

            $table->decimal('quantity', 15, 3);
            $table->decimal('remaining_quantity', 15, 3);

            $table->decimal('unit_cost', 15, 4);

            $table->timestamp('received_at');

            $table->timestamps();

            $table->index(['item_id', 'remaining_quantity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_batches');
    }
};