<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PagesTable extends Migration
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
            $table->string('h1')->default('');
            $table->longText('content')->nullable();
            $table->string('slug')->default('')->nullable();
            $table->string('category_id')->default(0)->nullable();
            $table->json('parameters')->nullable();

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


    private function getTable()
    {
        return 'pages';
    }
}
