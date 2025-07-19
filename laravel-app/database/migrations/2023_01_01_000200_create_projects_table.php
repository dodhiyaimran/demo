<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('project_date')->nullable();
            $table->string('energy_generation')->nullable();
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->text('info')->nullable();
            $table->text('scope')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
