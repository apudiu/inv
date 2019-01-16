<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceEntriesTable extends Migration
{
    // Quantity types
    private $types = ['hours','days','services','products','others'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_entries', function (Blueprint $table) {
            $table->increments('id');

            // FK
            $table->unsignedInteger('invoice_id');

            $table->integer('price');
            $table->integer('qty');
            $table->enum('qt_type', $this->types)->default($this->types[0]);
            $table->text('description');

            $table->timestamps();

            // FK constraint
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_entries');
    }
}
