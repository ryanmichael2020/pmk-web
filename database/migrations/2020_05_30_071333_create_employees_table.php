<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('job_post_id')->nullable();
            $table->string('age', 2)->nullable();
            $table->string('address', 512)->nullable();
            $table->string('mobile', 16)->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('job_post_id')->references('id')->on('job_posts');
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
        Schema::dropIfExists('employees');
    }
}
