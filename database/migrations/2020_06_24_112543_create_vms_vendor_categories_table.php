<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmsVendorCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms_vendor_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vendor_id')->references('id')->on('vms_vendors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('vms_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vms_vendor_categories');
    }
}
