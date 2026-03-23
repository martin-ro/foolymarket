<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_id');
            $table->foreignId('league_id')->constrained();
            $table->foreignId('season_id')->constrained();
            $table->foreignId('type_id')->constrained('types');
            $table->string('name');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('finished')->default(false);
            $table->boolean('is_current')->default(false);
            $table->date('starting_at')->nullable();
            $table->date('ending_at')->nullable();
            $table->boolean('games_in_current_week')->default(false);
            $table->foreignId('tie_breaker_rule_id')->nullable()->constrained('types');
            $table->timestamps();
        });
    }
};
