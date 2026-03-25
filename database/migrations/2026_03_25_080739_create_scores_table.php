<?php

use App\Models\Fixture;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fixture::class)->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->foreignId('participant_id')->constrained('teams')->cascadeOnDelete();
            $table->json('score');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
