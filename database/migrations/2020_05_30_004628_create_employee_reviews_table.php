<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->decimal('score');
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
        Schema::dropIfExists('employee_reviews');
    }
}
