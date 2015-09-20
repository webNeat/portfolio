<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectCategoryMigration extends Migration
{
    
    public function up()
    {
        Schema::create('project_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('descr')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('project_categories');
    }
}
