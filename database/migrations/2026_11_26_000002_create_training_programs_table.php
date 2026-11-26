<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->string('delivery_mode')->index();
            $table->string('registration_status')->index();
            $table->text('summary');
            $table->json('curriculum')->nullable();
            $table->string('target_audience');
            $table->string('schedule_label');
            $table->unsignedSmallInteger('duration_hours')->nullable();
            $table->string('lms_url')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_dummy')->default(true);
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_programs');
    }
};
