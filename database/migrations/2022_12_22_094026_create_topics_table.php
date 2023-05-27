<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'title');
            $table->longText(column: 'body');
            $table->longText(column: 'overview');

            $table->foreignId(column: 'course_id')->index()->constrained(table: 'courses')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
