<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCompanyHistoriesTable extends Migration
{
    /**
     * Run the migrations.e
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_company_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('job_post_id')->references('id')->on('job_posts');
            $table->timestamp('dismissed_at')->nullable();
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
        Schema::dropIfExists('employee_company_histories');
    }
}
