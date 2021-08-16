<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_b_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message', 500);
            $table->enum('level', [
                'DEBUG',
                'INFO',
                'NOTICE',
                'WARNING',
                'ERROR',
                'CRITICAL',
                'ALERT',
                'EMERGENCY'
            ])->default('INFO');
            $table->text('extra');
            $table->integer('user_id');
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
        Schema::dropIfExists('d_b_logs');
    }
}
