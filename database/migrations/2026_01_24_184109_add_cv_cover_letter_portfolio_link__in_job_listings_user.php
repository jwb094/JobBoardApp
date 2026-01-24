<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_listings_users', function (Blueprint $table) {
            //
            $table->string(column: 'cv')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('portfolio_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings_users', function (Blueprint $table) {
            //
        });
    }
};
