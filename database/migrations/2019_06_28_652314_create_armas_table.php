<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularioinspecoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cidade_id');
            $table->date('data')->nullable();
            
            $table->string('hora')->nullable();
            $table->string('placa')->nullable();
            $table->string('condutor')->nullable();
            $table->string('veiculo')->nullable();
            $table->string('oleoobs')->nullable();
            $table->string('aguaobs')->nullable();
            $table->string('limpadorobs')->nullable();
            $table->string('palhetaobs')->nullable();
            $table->string('faroisobs')->nullable();
            $table->string('observacao')->nullable();
            $table->string('oleo')->nullable();
            $table->string('agua')->nullable();
            $table->string('agualimpador')->nullable();
            $table->string('palheta')->nullable();
            $table->string('farois')->nullable();
            $table->string('rg')->nullable();
            $table->string('km')->nullable();
            $table->string('perito_id')->nullable();
            $table->longText('imagem_base64Lat')->nullable();
            $table->longText('imagem_base64LatEsq')->nullable();
            $table->longText('imagem_base64Frent')->nullable();
            $table->longText('imagem_base64Tran')->nullable();  
            $table->string('triangulo')->nullable();
            $table->string('estepe')->nullable();
            $table->string('chaveroda')->nullable();
            $table->string('macaco')->nullable();

            $table->string('estobs')->nullable();
            $table->string('triobs')->nullable();
            $table->string('chaobs')->nullable();
            $table->string('macoobs')->nullable();
            $table->string('view')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularioinspecoes');
    }
}
