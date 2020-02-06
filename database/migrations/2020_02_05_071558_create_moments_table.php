<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('user_id')->default('')->comment('发布用户');
            $table->string('cover_url',255)->default('')->comment('封面');
            $table->string('cate',16)->default('OTHER')->comment('类型MEDICAL医疗EXPRESS物流HOTEL酒店OTHER其他');
            $table->string('type',16)->default('PERSONAL')->comment('类型PERSONAL个人ORGANIZATION组织');
            $table->string('resource',16)->default('PERSONAL')->comment('信息来源PERSONAL个人NETWORK网络OTHER其他');
            $table->string('resource_remark',16)->default('PERSONAL')->comment('信息来源备注PERSONAL个人NETWORK网络OTHER其他');
            $table->string('province',32)->default('')->comment('地区省')->index('province');
            $table->string('city',32)->default('')->comment('地区市')->index('city');
            $table->string('address_detail',255)->default('')->comment('详细地址');
            $table->text('information')->comment('情况介绍');
            $table->text('important_information')->comment('重要信息');
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moments');
    }
}
