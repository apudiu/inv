<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    // invoice type
    private $types = ['estimate','invoice'];

    // statuses
    private $statuses = ['draft','partial','billed','accepted'];


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');

            // FK
            $table->unsignedInteger('client_id');

            $table->string('p_o_no')->unique();
            $table->enum('type', $this->types)->default($this->types[0]);
            $table->enum('status', $this->statuses)->default($this->statuses[0]);

            $table->timestamps();

            // FK constraint
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
