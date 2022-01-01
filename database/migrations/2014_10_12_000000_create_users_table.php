<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->string('pin')->nullable();
            $table->string('referral_id')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('user_id')->nullable();
            $table->string('balance')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('last_login')->nullable();
            $table->string('kyc_link')->nullable();
            $table->string('kyc_type')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('kyc_status')->default(0);
            $table->string('googlefa_secret')->nullable();
            $table->boolean('fa_status')->default(0);
            $table->string('fa_expiring')->nullable();
            $table->string('api_token')->nullable();
            $table->text('kyc_reason')->nullable();
            $table->string('ref_bonus')->nullable()->default(0);
            $table->integer('referral')->nullable();
            $table->boolean('referral_paid')->default(0);
            $table->string('next_check')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
