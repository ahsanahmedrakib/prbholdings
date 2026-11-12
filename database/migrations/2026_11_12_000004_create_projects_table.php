<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->string('location');
            $table->longText('description')->nullable();
            $table->string('status')->default('ongoing');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('nature')->default('Residential');
            $table->string('floors')->nullable();
            $table->string('land_area')->nullable();
            $table->string('facing')->nullable();
            $table->unsignedSmallInteger('total_apartments')->nullable();
            $table->unsignedTinyInteger('total_lifts')->nullable();
            $table->json('apartment_types')->nullable();
            $table->json('features')->nullable();
            $table->text('ground_floor')->nullable();
            $table->string('handover_year')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('location_image')->nullable();
            $table->string('brochure_file')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
