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
            $table->text('description'); 
            $table->decimal('price', 10, 2); 
            $table->enum('type', ['acheter', 'louer'])->default('louer');
            $table->string('ville');
            $table->enum('status', ['accepted', 'rejected', 'waiting'])->default('waiting')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
