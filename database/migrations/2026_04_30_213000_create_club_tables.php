<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('master_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('instructor_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->enum('time_slot', ['9-11', '11-13', '13-15', '15-17']);
            $table->integer('max_participants');
            $table->decimal('price', 10, 2);
            $table->timestamps();
            
            $table->unique(['instructor_id', 'date', 'time_slot']);
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('master_class_id')->constrained('master_classes');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
            
            $table->unique(['user_id', 'master_class_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('master_classes');
        Schema::dropIfExists('categories');
    }
};