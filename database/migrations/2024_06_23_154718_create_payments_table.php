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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('users');
            $table->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['credit_card', 'debit_card', 'deposit', 'paypal', 'cash', 'other'])->default('cash');
            $table->decimal('amount');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->enum('status', ['succeeded', 'canceled', 'failed'])->default('succeeded');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
