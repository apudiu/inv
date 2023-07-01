<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectEntriesTable extends Migration
{
    // statuses
    private $allowed = [0, 1];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_entries', function (Blueprint $table) {
            $table->increments('id');

            // FK
            $table->unsignedInteger('project_id');

            $table->integer('rate');
            $table->integer('hour');
            $table->enum('status', $this->allowed)->default($this->allowed[0]);
            $table->text('description');

            $table->timestamps();

            // FK constraints
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_entries');
    }
}
