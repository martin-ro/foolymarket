<?php

use App\Models\Sport;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rivals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Team::class)->constrained()->cascadeOnDelete();
            $table->foreignId('rival_id')->constrained('teams')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
