<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_frontend_name')->nullable()->after('product_id');
            $table->decimal('cost_price', 8, 2)->default(0)->after('depth');
            $table->decimal('profit_percentage', 5, 2)->nullable()->after('cost_price');
            $table->decimal('selling_price', 8, 2)->nullable()->after('profit_percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('product_frontend_name');
            $table->dropColumn('cost_price');
            $table->dropColumn('profit_percentage');
            $table->dropColumn('selling_price');
        });
    }
}
