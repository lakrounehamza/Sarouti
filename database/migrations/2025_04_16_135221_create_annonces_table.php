<?php

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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description'); // Utiliser 'text' au lieu de 'string' pour des descriptions longues
            $table->decimal('price', 10, 2); // 'decimal' pour les prix au lieu de 'string'
            $table->enum('type', ['rental', 'sale'])->default('rental');
            $table->string('ville');
            $table->enum('status', ['accepted', 'rejected', 'waiting'])->default('waiting')->nullable();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
