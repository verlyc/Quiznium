<?php

use App\Enums\QuestionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->enum('type', QuestionTypeEnum::toArray())->default(QuestionTypeEnum::single_choice->name);
            $table->string('image')->nullable();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
