<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceRecursTable extends Migration
{
    // enabled or disabled
    private $allowed = [0,1];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_recurs', function (Blueprint $table) {
            $table->increments('id');
            
            // FK
            $table->unsignedInteger('invoice_id');
            
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('interval')->comment('in days');
            $table->enum('enabled', $this->allowed)->default($this->allowed[0]);
            $table->enum('send_invoice', $this->allowed)->default($this->allowed[1]);

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
        Schema::dropIfExists('invoice_recurs');
    }
}
