<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table): void {
            $table->id();

            $table->longText(column: 'body');
            $table->boolean(column: 'correct_option')->nullable();
            $table->boolean(column: 'active')->default(true);
            $table->longText(column: 'explanation')->nullable();

            $table->foreignId(column: 'question_id')->index()->nullable()->constrained(table: 'questions')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
