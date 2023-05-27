<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('question_bank_user', function (Blueprint $table): void {
            $table->id();

            $table->integer(column: 'user_score');
            $table->integer(column: 'max_score');

            $table->foreignId(column: 'user_id')->constrained();
            $table->foreignId(column: 'question_bank_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_bank_user');
    }
};
