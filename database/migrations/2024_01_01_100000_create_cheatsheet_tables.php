<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon', 10)->nullable();
            $table->string('color', 7)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color', 7)->default('#6366f1');
            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('since_version', 10)->nullable();
            $table->string('difficulty')->default('beginner');
            $table->string('type')->default('concept');
            $table->timestamps();
        });

        Schema::create('feature_tag', function (Blueprint $table) {
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['feature_id', 'tag_id']);
        });

        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('definition');
            $table->timestamps();
        });

        Schema::create('feature_term', function (Blueprint $table) {
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->constrained()->cascadeOnDelete();
            $table->primary(['feature_id', 'term_id']);
        });

        Schema::create('code_examples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('code');
            $table->string('language')->default('php');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_examples');
        Schema::dropIfExists('feature_term');
        Schema::dropIfExists('terms');
        Schema::dropIfExists('feature_tag');
        Schema::dropIfExists('features');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};
