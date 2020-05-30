<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeReviewScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_review_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_review_id')->references('id')->on('employee_reviews');
            $table->foreignId('employee_review_type_id')->references('id')->on('employee_review_types');
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
        Schema::dropIfExists('employee_review_scores');
    }
}
