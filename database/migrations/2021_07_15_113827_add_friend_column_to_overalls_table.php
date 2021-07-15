<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFriendColumnToOverallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overalls', function (Blueprint $table) {
            if (!Schema::hasColumn('overalls', 'friend')){
                $table->string('friend')->default('0')->after('tiktok');
              };
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overalls', function (Blueprint $table) {
            $table->dropColumn(['friend']);
        });
    }
}
