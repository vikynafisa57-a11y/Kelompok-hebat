<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('career_target_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_target_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('required_level')->default(3);
            $table->timestamps();
            $table->unique(['career_target_id', 'skill_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('career_target_skill'); }
};
