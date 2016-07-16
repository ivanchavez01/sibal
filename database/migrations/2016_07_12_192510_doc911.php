<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Doc911 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('doc911'))
        {
            Schema::create('doc911', function(Blueprint $table){
                $table->char('user_sibal', 12);
                $table->integer('lot_id')->unsigned();
                $table->longText('data');
                $table->date('created_at');
                $table->date('updated_at');
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
        //Schema::drop('doc911');
    }
}
