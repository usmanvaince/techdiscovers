<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('categories') && !Schema::hasColumn('categories','slug_category')) {
                 Schema::table('categories', function (Blueprint $table) {
                     $table->string('slug_category')->unique();
                 });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if ( Schema::hasTable('categories') && Schema::hasColumn('categories','slug_category')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('slug_category');
            });

        }
    }
}
