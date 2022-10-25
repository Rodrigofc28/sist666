<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumeroLacreSaidaToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('armas',function(Blueprint $table){
            $table->string('num_lacre_saida')->nullable();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('laudos',function(Blueprint $table){
            $table->dropColumn('num_lacre_saida');
            
           });
    }
}