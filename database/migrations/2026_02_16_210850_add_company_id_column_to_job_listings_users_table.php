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
            $table->foreignId('company_id')
                ->nullable() // important if table already has data
                ->constrained('companies')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings_users', function (Blueprint $table) {
            //
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
