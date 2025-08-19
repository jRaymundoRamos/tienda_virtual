<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('redirects', function (Blueprint $t) {
            $t->id();
            $t->string('from_path')->unique();
            $t->string('to_path');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('redirects'); }
};
