<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxValuesToStatsAndStatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stat_user', function (Blueprint $table) {
            $table->string('max_value')->nullable()->after('value');
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->string('default_max_value')->nullable()->after('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stat_user', function (Blueprint $table) {
            $table->dropColumn(['max_value']);
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn(['default_max_value']);
        });
    }
}
