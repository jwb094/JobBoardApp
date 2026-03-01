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
            // 1️⃣ Drop foreign key on old company column (if exists)
            $table->dropForeign(['company']);

            // // 2️⃣ Drop the old column
            $table->dropColumn('company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings_users', function (Blueprint $table) {
            //
            // Drop new foreign key
            $table->dropForeign(['company_id']);

            // Drop new column
            $table->dropColumn('company_id');

            // Recreate old column
            $table->unsignedBigInteger('company');

            // Recreate old foreign key (if needed)
            $table->foreign('company')
                ->references('id')
                ->on('companies')
                ->cascadeOnDelete();
        });
    }
};
