<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mulkning egasi
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade'); // Mulk turi (uy, ofis, yer, ...)
            $table->foreignId('property_agent_id')->nullable()->constrained()->onDelete('cascade'); // Agent (bo‘lsa)
            $table->string('title'); // Sarlavha
            $table->text('description'); // Tavsif
            $table->decimal('price', 10, 2); // Narx
            $table->string('location'); // Joylashuv
            $table->boolean('is_for_rent')->default(false); // Ijaraga berish
            $table->boolean('is_for_sale')->default(false); // Sotish
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
