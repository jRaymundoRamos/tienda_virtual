<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('short_description')->nullable();
            $t->longText('description')->nullable(); // HTML permitido
            $t->string('sku')->nullable()->unique();
            $t->string('brand')->nullable();
            $t->decimal('display_price', 12, 2)->nullable(); // solo informativo
            $t->boolean('is_published')->default(false);
            $t->timestamp('published_at')->nullable();
            // SEO
            $t->string('seo_title')->nullable();
            $t->text('seo_description')->nullable();
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();

            $t->index(['is_published','published_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
