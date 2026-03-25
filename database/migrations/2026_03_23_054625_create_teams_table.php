<?php

use App\Models\Country;
use App\Models\Sport;
use App\Models\Venue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Country::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Venue::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('gender');
            $table->string('name');
            $table->string('short_code')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedSmallInteger('founded')->nullable();
            $table->string('type');
            $table->boolean('placeholder')->default(false);
            $table->timestamp('last_played_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
