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
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();
            $table->string('number')->unique();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'processing', 'completed', 'declined'])
                ->default('pending');
            $table->decimal('shipping_price')->nullable();
            $table->longText('notes');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    //Important soft Delete() :: Soft Deleting in Laravel permits you to mark a database record as “deleted” instead of
    //actually deleting it from the database. When records are soft deleted, they are not actually removed from your
    //database. A “deleted_at” attribute is set on the record indicating the date and time at which the record was “deleted”

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
