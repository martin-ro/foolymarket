<?php

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_squads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id')->nullable();
            $table->foreignIdFor(Player::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('types');
            $table->foreignId('detailed_position_id')->nullable()->constrained('types');
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->boolean('captain')->default(false);
            $table->unsignedSmallInteger('jersey_number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
