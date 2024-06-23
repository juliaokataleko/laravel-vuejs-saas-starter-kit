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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('descriotion')->nullable();
            $table->json('features')->nullable();
            $table->boolean('is_free')->default(false);
            $table->decimal('price')->default(0);    

            $table->boolean('active')->default(true);        
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
