<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmsVendorQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms_vendor_quotation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('assign_vendor_id')->unsigned();
            $table->text('comment')->nullable();
            $table->text('admin_comment')->nullable();
            $table->string('quotation_doc',150);
            $table->enum('status', ['in_process','approved', 'rejected'])->default('in_process');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('assign_vendor_id')->references('id')->on('vms_assign_vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vms_vendor_quotation');
    }
}
