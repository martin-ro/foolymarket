<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('legacy_id')->nullable();
            $table->string('name');
            $table->string('developer_name')->nullable();
            $table->boolean('has_winning_calculations');
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
