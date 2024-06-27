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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('users');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('business_id')->nullable()->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->enum('billing_cycle', ['monthly', 'quarterly', 'semiannually', 'yearly'])->default('monthly');
            $table->decimal('amount')->nullable();
            $table->enum('status', ['active', 'pending', 'canceled', 'past_due'])->default('pending');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->boolean('active')->default(true);   
            $table->boolean('is_trial')->default(false);   
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
