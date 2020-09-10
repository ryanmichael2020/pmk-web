<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_offer_status_id')->references('id')->on('job_offer_statuses');

            $table->unsignedBigInteger('job_post_application_id')->unique();
            $table->foreignId('job_post_id')->references('id')->on('job_posts');
            $table->foreignId('company_id')->references('id')->on('companies');

            $table->foreignId('employer_id')->references('id')->on('employers');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->string('description', 8096)->nullable();

            $table->foreign('job_post_application_id')->references('id')->on('job_post_applications');
            $table->timestamp('date_due');
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
        Schema::dropIfExists('job_offers');
    }
}
