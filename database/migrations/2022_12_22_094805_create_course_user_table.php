<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('course_user', function (Blueprint $table): void {
            $table->id();

            $table->foreignId(column: 'course_id')->index()->nullable()->constrained(table: 'courses')->nullOnDelete();
            $table->foreignId(column: 'user_id')->index()->nullable()->constrained(table: 'users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
