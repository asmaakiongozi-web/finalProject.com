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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable(); // For text content or file path
            $table->string('category')->default('general'); // general, anxiety, depression, etc.
            $table->string('type')->default('article'); // article, video, pdf, etc.
            $table->string('file_path')->nullable(); // For uploaded files
            $table->unsignedBigInteger('posted_by'); // user_id of professional or admin
            $table->string('posted_by_type'); // 'professional' or 'admin'
            $table->timestamps();

            $table->foreign('posted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
