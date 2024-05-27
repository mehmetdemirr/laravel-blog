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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->boolean('status')->default(0);
            $table->boolean('feature_status')->default(0);
            $table->string('desciption')->nullable();
             $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0); //tasarımda sıralama 
            $table->string('seo_keywords')->nullable();
            $table->string('seo_desciption')-> nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
