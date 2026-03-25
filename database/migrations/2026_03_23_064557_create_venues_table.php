<?php

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->string('image_path')->nullable();
            $table->string('city_name')->nullable();
            $table->string('surface')->nullable();
            $table->boolean('national_team')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
