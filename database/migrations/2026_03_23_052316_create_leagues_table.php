<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_id');
            $table->foreignId('country_id')->constrained();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->string('short_code')->nullable();
            $table->string('image_path')->nullable();
            $table->string('type');
            $table->string('sub_type');
            $table->timestamp('last_played_at')->nullable();
            $table->unsignedSmallInteger('category');
            $table->boolean('has_jerseys')->default(false);
            $table->timestamps();
        });
    }
};
