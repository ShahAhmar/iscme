<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->text('description')->nullable(); $table->timestamps(); });
        Schema::create('posts', function (Blueprint $table) { $table->id(); $table->string('title'); $table->string('slug')->unique(); $table->text('excerpt')->nullable(); $table->longText('body')->nullable(); $table->string('featured_image')->nullable(); $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete(); $table->string('status', 20)->default('draft')->index(); $table->timestamp('published_at')->nullable()->index(); $table->string('seo_title')->nullable(); $table->text('seo_description')->nullable(); $table->timestamps(); });
    }
    public function down(): void { Schema::dropIfExists('posts'); Schema::dropIfExists('categories'); }
};
