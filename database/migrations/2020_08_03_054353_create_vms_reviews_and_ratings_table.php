<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmsReviewsAndRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms_reviews_and_ratings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('requirement_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('vms_vendors')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('vms_requirements')->onDelete('cascade');
            $table->string('rating');
            $table->string('review');
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
        Schema::dropIfExists('vms_reviews_and_ratings');
    }
}
