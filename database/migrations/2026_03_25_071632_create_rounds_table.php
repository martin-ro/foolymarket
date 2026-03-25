<?php

use App\Models\League;
use App\Models\Season;
use App\Models\Sport;
use App\Models\Stage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(League::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Stage::class)->constrained()->cascadeOnDelete();
            $table->string('name');
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
