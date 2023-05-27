<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'key')->unique();

            $table->string(column: 'title');
            $table->string(column: 'code');
            $table->longText(column: 'description')->nullable();

            $table->string(column: 'status');

            $table->foreignId(column: 'user_id')->index()->nullable()->constrained(table: 'users');
            $table->foreignId(column: 'level_id')->index()->nullable()->constrained(table: 'levels');
            $table->foreignId(column: 'department_id')->index()->nullable()->constrained(table: 'departments');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
