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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->uuid()->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('users');
            $table->foreignId('business_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('avatar_url')->nullable();

            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('username')->unique()->nullable();

            $table->text('about')->nullable();
            $table->string('doc')->nullable();

            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId('state_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('address')->nullable();

            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('job')->nullable();
            $table->decimal('salary')->nullable();

            $table->enum('level', ['admin', 'manager', 'employee', 'seller'])->default('manager'); // admin, manager, employee, seller

            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
