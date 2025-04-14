<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->string('name');  // Product name
            $table->text('description')->nullable(); // Product description
            $table->decimal('price', 10, 2); // Product price
            $table->integer('stock')->default(0); // Stock quantity
            $table->timestamps();  // Created_at and Updated_at columns
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
