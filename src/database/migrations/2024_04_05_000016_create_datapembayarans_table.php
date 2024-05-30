<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatapembayaransTable extends Migration
{
    public function up()
    {
        Schema::create('datapembayarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('no')->nullable();
            $table->date('tanggal')->nullable();
            $table->decimal('total', 15, 3)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
