<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Mulk bilan bog‘lash
            $table->string('image_path'); // Rasm yo‘li
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_images');
    }
};

