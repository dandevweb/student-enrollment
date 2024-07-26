<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('birth_date');
            $table->integer('segment');
            $table->integer('grade');
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('address_type');
            $table->string('street');
            $table->string('zip_code');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
