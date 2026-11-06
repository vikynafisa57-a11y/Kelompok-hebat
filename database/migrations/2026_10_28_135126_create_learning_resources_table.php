<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('learning_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_target_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('level')->default('Pemula');
            $table->unsignedInteger('sequence')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('learning_resources'); }
};
