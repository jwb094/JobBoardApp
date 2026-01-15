<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();

            // Employer
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('skillset_About');
            $table->text('benefits');
            $table->string('location');

            $table->enum('job_type', [
                'full-time',
                'part-time',
                'contract',
                'remote'
            ]);

            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            $table->enum('status', ['open', 'closed'])->default('open');
            $table->date('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
