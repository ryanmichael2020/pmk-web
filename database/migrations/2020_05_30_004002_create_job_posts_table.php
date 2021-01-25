<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->references('id')->on('employers');
            $table->foreignId('company_id')->references('id')->on('job_posts');
            $table->foreignId('job_post_status_id')->references('id')->on('job_post_statuses');
            $table->string('position', 128);
            $table->string('description', 8096);
            $table->integer('max_applicants');
            $table->integer('approved_applicants')->default(0);
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
        Schema::dropIfExists('job_posts');
    }
}
