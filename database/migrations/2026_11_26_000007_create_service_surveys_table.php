<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('service_type')->index();
            $table->string('respondent_name')->nullable();
            $table->string('respondent_unit')->nullable();
            $table->unsignedTinyInteger('rating_clarity');
            $table->unsignedTinyInteger('rating_speed');
            $table->unsignedTinyInteger('rating_officer');
            $table->unsignedTinyInteger('rating_facility');
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_surveys');
    }
};
