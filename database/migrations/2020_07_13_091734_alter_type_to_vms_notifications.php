<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTypeToVmsNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vms_notifications', function (Blueprint $table) {
            DB::statement("ALTER TABLE vms_notifications CHANGE `type` `type` ENUM('vendor_register','document_update','vendor_update','new_requirement','admin_comment','new_review_rating')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vms_notifications', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
