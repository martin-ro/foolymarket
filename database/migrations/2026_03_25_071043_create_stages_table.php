<?php

use App\Models\League;
use App\Models\Season;
use App\Models\Sport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(League::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained('types');
            $table->foreignId('tie_breaker_rule_id')->nullable()->constrained('types');
            $table->string('name');
            $table->unsignedSmallInteger('sort_order')->nullable();
            $table->boolean('finished')->default(false);
            $table->boolean('is_current')->default(false);
            $table->date('starting_at')->nullable();
            $table->date('ending_at')->nullable();
            $table->boolean('games_in_current_week')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
