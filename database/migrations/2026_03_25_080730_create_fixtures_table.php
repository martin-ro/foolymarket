<?php

use App\Models\League;
use App\Models\Round;
use App\Models\Season;
use App\Models\Sport;
use App\Models\Stage;
use App\Models\State;
use App\Models\Venue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(League::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Stage::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('aggregate_id')->nullable();
            $table->foreignIdFor(Round::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(State::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Venue::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->dateTime('starting_at');
            $table->string('result_info')->nullable();
            $table->string('leg')->nullable();
            $table->text('details')->nullable();
            $table->unsignedSmallInteger('length')->nullable();
            $table->boolean('placeholder')->default(false);
            $table->boolean('has_odds')->default(false);
            $table->boolean('has_premium_odds')->default(false);
            $table->unsignedBigInteger('starting_at_timestamp');
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
