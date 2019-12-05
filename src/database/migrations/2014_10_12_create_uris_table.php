<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UrisTable extends Migration
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
            $table->string('uri')->unique()->default('');
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedBigInteger('entity_id')->default(0);

        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `urls` ADD INDEX `urls_` (`entity_id`, `type`) using HASH;');
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
        return 'urls';
    }
}
