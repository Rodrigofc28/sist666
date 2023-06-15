<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('imagem_base64')->nullable();
            $table->longText('mensagens')->nullable();
            $table->longText('upload_image')->nullable();
            $table->string('perito_id',80);
            
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
        Schema::dropIfExists('formularios');
    }
}
