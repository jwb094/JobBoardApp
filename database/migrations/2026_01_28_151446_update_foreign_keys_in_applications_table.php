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
        Schema::table('applications', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);

            // Add the correct foreign key pointing to job_listings_users
            $table->foreign('user_id')
                ->references('id')
                ->on('job_listings_users')
                ->onDelete('cascade');

            $table->dropForeign(['job_id']);

            // Add the correct foreign key pointing to job_listings
            $table->foreign('job_listing_id')
                ->references('id')
                ->on('job_listings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
};
