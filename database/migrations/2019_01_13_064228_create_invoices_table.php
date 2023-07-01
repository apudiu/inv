<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // invoice type
        $types = config('app.invoice.type');

        // statuses
        $statuses = config('app.invoice.status');

        Schema::create('invoices', function (Blueprint $table) use ($types, $statuses) {
            $table->increments('id');

            // FK
            $table->unsignedInteger('client_id');

            $table->string('p_o_no')->unique()->nullable();
            $table->enum('type', $types)->default($types[0]);
            $table->enum('status', $statuses)->default($statuses[0]);

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
