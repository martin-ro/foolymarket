<?php

use App\Models\Continent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Continent::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('official_name')->nullable();
            $table->string('fifa_name', 3)->nullable();
            $table->char('iso2', 2)->nullable();
            $table->char('iso3', 3)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('borders')->nullable();
            $table->string('image_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
