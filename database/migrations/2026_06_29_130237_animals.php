<?php

use App\Enums\SexeAnimal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('photo')->nullable();
            $table->date('age');
            $table->string('state')->nullable();
            $table->enum('sexe', SexeAnimal::cases());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
