<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmsVendorDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms_vendor_document', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->text('reason')->nullable();
            $table->enum('status', ['approved', 'pending','rejected'])->default('pending');
            $table->enum('is_uploaded', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vendor_id')->references('id')->on('vms_vendors')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('vms_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vms_vendor_document');
    }
}
