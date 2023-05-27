<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('discussions', function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->text('title');
            $table->longText('body');
            $table->boolean('is_question')->default(0);
            $table->unsignedBigInteger('solved_id')->nullable(); //indicates which comment was choosen as the answer
            // $table->foreignId(column: 'closed_id')->constrained();
            $table->json('tags');
            $table->foreignId(column: 'topic_id')->constrained();
            $table->foreignId(column: 'user_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
