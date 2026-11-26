<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->index();
            $table->text('excerpt');
            $table->longText('body');
            $table->string('cover_image_path')->nullable();
            $table->string('attachment_path')->nullable();
            $table->date('event_date')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_dummy')->default(true);
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
