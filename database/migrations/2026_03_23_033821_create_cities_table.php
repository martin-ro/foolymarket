<?php

use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Region::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('latitude', 10, 5)->nullable();
            $table->decimal('longitude', 10, 5)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
