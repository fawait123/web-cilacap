<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pollstations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provinceID');
            $table->bigInteger('districtID');
            $table->bigInteger('subdistrictID');
            $table->bigInteger('villageID');
            $table->string('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pollstations');
    }
};
