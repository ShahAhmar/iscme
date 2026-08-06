<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->string('tier', 100)->nullable();
            $table->string('logo')->nullable(); $table->string('website_url', 2048)->nullable();
            $table->boolean('is_published')->default(true)->index(); $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('sponsors'); }
};
