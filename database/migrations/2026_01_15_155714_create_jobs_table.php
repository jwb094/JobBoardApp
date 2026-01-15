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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            // Employer who posted the job
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description');
            $table->text('description');
            $table->text('benefits');
            $table->string('location');

            // Job type
            $table->enum('job_type', [
                'full-time',
                'part-time',
                'contract',
                'remote'
            ]);

            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            // Job status
            $table->enum('status', ['open', 'closed'])->default('open');

            $table->date('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
