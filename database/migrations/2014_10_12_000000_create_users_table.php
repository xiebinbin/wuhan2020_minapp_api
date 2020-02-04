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
            $table->unsignedBigInteger('id')->primary();
            $table->string('name')->nullable()->default('')->comment('用户名');
            $table->string('phone',16)->default('')->comment('手机号')->index('phone');
            $table->string('contact_number',16)->nullable()->default('')->comment('联系电话');
            $table->string('avatar_url',255)->nullable()->default('')->comment('头像地址');
            $table->string('role',16)->nullable()->default('')->comment('身份');
            $table->string('province',16)->nullable()->default('')->comment('省');
            $table->string('city',16)->nullable()->default('')->comment('市');
            $table->string('signature',255)->nullable()->default('')->comment('个性签名');
            $table->string('status',32)->nullable()->default('FIRST_LOGIN')->comment('状态FIRST_LOGIN首次登录NORMAL正常');
            $table->string('email')->default('')->index('email');
            $table->string('contact_email',255)->nullable()->default('')->comment('联系邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
