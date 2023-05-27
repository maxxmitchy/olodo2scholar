<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('slides', function (Blueprint $table): void {
            $table->id();

            $table->string(column: 'key')->unique();
            $table->string(column: 'title')->nullable();
            $table->longText(column: 'body')->nullable();
            $table->string('image')->nullable();

            $table->boolean('type')->default(0);

            $table->foreignId(column: 'summary_id')->index()->nullable()->constrained(table: 'summaries');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
