<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->unsignedBigInteger('product_id'); // Relasi ke tabel products
            $table->integer('quantity'); // Jumlah produk
            $table->decimal('total_price', 10, 2); // Total harga
            $table->timestamps(); // Kolom created_at & updated_at

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
