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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category_id');
            $table->string('blog_title')->nullable();
            $table->string('blog_description_1')->nullable();
            $table->string('blog_description_2')->nullable();
            $table->string('blog_description_3')->nullable();
            $table->string('blog_description_4')->nullable();
            $table->string('blog_tag')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('status')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
