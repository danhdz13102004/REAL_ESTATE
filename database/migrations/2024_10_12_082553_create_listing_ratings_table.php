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
        Schema::create('listing_ratings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->foreignId('user_id')->constrained();
            $table->foreignId('listing_id')->constrained();
            $table->string('comment');
            $table->tinyInteger('rate');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_ratings');
    }
};
