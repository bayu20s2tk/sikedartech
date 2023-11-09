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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->integer('comment_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('category_id');
            $table->integer('status_id');
            $table->longText('desc');

            $table->foreign('course_id')->on('courses')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id')->on('projects')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('blog_id')->on('blogs')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
