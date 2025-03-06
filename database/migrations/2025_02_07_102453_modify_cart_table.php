<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('session_id'); // Remove old session_id column
        $table->string('cookie_id')->nullable()->after('user_id'); // Add cookie_id column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('cookie_id'); // Remove cookie_id if rolling back
            $table->string('session_id')->nullable()->after('user_id'); // Restore session_id
        });
    }
}
