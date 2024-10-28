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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('code');
            $table->string('unit');
            $table->string('buying_price')->nullable();
            $table->integer('featured')->nullable();
            $table->string('tag')->nullable();
            $table->string('selling_price');
            $table->string('inspired_product')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('status')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->text('details')->nullable();
            $table->string('views')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
