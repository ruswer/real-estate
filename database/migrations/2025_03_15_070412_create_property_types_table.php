<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable(); // Masalan, img/icon-apartment.png
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_types');
    }
};
