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
            $table->string('name');
            $table->string('email')->unique()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type')->default(null);
            $table->string('document')->unique();
            $table->string('rg')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->string('file')->nullable();

            $table->foreignId('user_permission_id')->nullable(false)->default(3)->constrained('user_permissions');
            $table->foreignId('company_id')->default(null)->nullable(true)->constrained('companies');
            $table->foreignId('department_id')->default(null)->nullable(true)->constrained('departments');

            $table->rememberToken();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_permission_id']);
        });

        Schema::dropIfExists('users');
    }
}
