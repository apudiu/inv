<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_person', function (Blueprint $table) {
            $table->increments('id');

            // FK 1
            $table->unsignedInteger('invoice_id');
            // FK 2
            $table->unsignedInteger('person_id');

            $table->timestamps();

            // FK constraints
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('person_id')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_person');
    }
}
