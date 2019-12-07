<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('meta_title')->default('');
            $table->string('meta_description')->default('');
            $table->string('meta_keywords')->default('');
            $table->string('h1')->default('')->nullable();
            $table->string('slug')->default('')->nullable();
            $table->string('path')->default('')->nullable();
            $table->unsignedInteger('parent_id')->default(1)->nullable();
            $table->unsignedSmallInteger('level')->default(1)->nullable();
            $table->unsignedInteger('sort')->default(500)->nullable();
            $table->longText('content')->default('')->nullable();

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
        Schema::dropIfExists($this->getTable());
    }

    private function getTable(){
        return 'categories';
    }
}
