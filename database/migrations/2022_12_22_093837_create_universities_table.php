<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'key')->unique();

            $table->string(column: 'name');
            $table->longText(column: 'description')->nullable();
            $table->foreignId(column: 'location_id')->index()->constrained(table: 'locations');
            $table->boolean(column: 'active')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('universities');
    }
};
