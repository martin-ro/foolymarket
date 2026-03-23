<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_id');
            $table->foreignId('league_id')->nullable()->constrained();
            $table->foreignId('season_id')->nullable()->constrained();
            $table->foreignId('stage_id')->nullable()->constrained();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('aggregate_id')->nullable();
            $table->unsignedBigInteger('round_id')->nullable();
            $table->foreignId('state_id')->nullable()->constrained();
            $table->foreignId('venue_id')->nullable()->constrained();
            $table->string('name');
            $table->timestamp('starting_at')->nullable();
            $table->string('result_info')->nullable();
            $table->string('leg')->nullable();
            $table->text('details')->nullable();
            $table->unsignedSmallInteger('length')->default(90);
            $table->boolean('placeholder')->default(false);
            $table->boolean('has_odds')->default(false);
            $table->boolean('has_premium_odds')->default(false);
            $table->unsignedInteger('starting_at_timestamp')->nullable();
            $table->timestamps();
        });
    }
};
