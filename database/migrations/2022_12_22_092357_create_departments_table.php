<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'name');
            $table->string(column: 'abbreviation')->nullable();
            $table->text(column: 'description')->nullable();

            $table->boolean(column: 'active')->nullable()->default(true);

            $table->foreignId(column: 'faculty_id')->index()->constrained(table: 'faculties')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
