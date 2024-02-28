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
        Schema::create('tasks', function(Blueprint $table){
            $table->id();
            $table->string('name',255)->nullable(false);
            $table->string('description',255)->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable(false);
            $table->boolean('completed')->default(false);
            $table->enum('week_day', ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
