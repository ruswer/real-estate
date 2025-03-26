<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveImageFromPropertyAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_agents', function (Blueprint $table) {
            $table->dropColumn('image');  // 'image' ustunini o'chirish
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_agents', function (Blueprint $table) {
            $table->string('image')->nullable();  // Agar migratsiyani qaytarish kerak bo'lsa, 'image' ustunini qaytarish
        });
    }
}
