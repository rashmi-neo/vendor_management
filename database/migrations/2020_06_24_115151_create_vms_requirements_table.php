<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVmsRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms_requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('code',50);
            $table->string('title',100);
            $table->string('description',250);
            $table->string('budget',100);
            $table->date('from_date');
            $table->date('to_date');
            $table->enum('priority', ['low','medium', 'high']);
            $table->string('proposal_document',100)->nullable();
            $table->text('comment')->nullable();
            $table->enum('status', ['in_progress','approved', 'completed','cancelled'])->default('in_progress');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('vms_categories')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vms_requirements');
    }
}
