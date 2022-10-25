<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLacrecartuchoToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('municoes',function(Blueprint $table){
            $table->string('lacrecartucho')->nullable();
    });}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('municoes',function(Blueprint $table){
            $table->dropColumn('lacrecartucho');
            
           });
    }
}