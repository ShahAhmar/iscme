<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up():void{Schema::create('menu_items',function(Blueprint $t){$t->id();$t->string('label');$t->string('url',2048);$t->string('location',30)->default('header')->index();$t->string('target',20)->default('_self');$t->unsignedSmallInteger('sort_order')->default(0);$t->boolean('is_published')->default(true);$t->timestamps();});}public function down():void{Schema::dropIfExists('menu_items');}};
