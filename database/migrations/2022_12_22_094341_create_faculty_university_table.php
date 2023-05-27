<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('faculty_university', function (Blueprint $table): void {
            $table->id();

            $table->foreignId(column: 'faculty_id')->index()->nullable()->constrained(table: 'faculties')->nullOnDelete();
            $table->foreignId(column: 'university_id')->index()->nullable()->constrained(table: 'universities')->nullOnDelete();

            $table->integer('students_count')->default(0);
            $table->integer('departments_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_university');
    }
};
