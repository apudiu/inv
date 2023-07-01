<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    // allowed status types
    private $allowed = ['draft', 'partial', 'billed'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            // FK
            $table->unsignedInteger('client_id');

            $table->string('name');
            $table->text('description');
            $table->enum('status', $this->allowed)->default($this->allowed[0]);

            $table->timestamps();

            // FK constraints
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
        Schema::dropIfExists('projects');
    }
}
