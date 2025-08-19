<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug');
            $t->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $t->boolean('is_active')->default(true);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
            $t->unique(['parent_id','slug']); // slug único por padre
            $t->index(['is_active','sort_order']);
        });
    }
    public function down(): void { Schema::dropIfExists('categories'); }
};
