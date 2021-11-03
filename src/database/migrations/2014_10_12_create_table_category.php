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

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('h1')->nullable();
            $table->string('slug')->nullable();
            $table->string('path')->nullable();
            $table->unsignedInteger('parent_id')->default(0)->index();
            $table->unsignedSmallInteger('level')->default(1);
            $table->unsignedInteger('sort')->default(500);
            $table->longText('content');

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
