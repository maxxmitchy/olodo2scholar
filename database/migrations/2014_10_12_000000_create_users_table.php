<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();
            $table->string(column: 'last_name');
            $table->string(column: 'first_name');
            $table->string(column: 'email')->unique();
            $table->integer(column: 'sex')->nullable();
            $table->string(column: 'phone')->nullable();
            $table->date(column: 'date_of_birth')->nullable();
            $table->string(column: 'registeration_number')->nullable();
            $table->unsignedBigInteger(column: 'parent_id')->nullable();

            $table->foreignId(column: 'department_id')->index()->nullable()->constrained(table: 'departments')->nullOnDelete();

            $table->foreignId(column: 'university_id')->index()->nullable()->constrained(table: 'universities')->nullOnDelete();

            $table->foreignId(column: 'level_id')->index()->nullable()->constrained(table: 'levels')->nullOnDelete();

            $table->timestamp(column: 'trial_ends_at')->nullable();

            $table->string(column: 'password');

            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
