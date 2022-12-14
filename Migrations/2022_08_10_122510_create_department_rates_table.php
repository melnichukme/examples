<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_rates', function (Blueprint $table) {
            $table->unsignedSmallInteger('department_id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('rate')->default(0);

            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_rates');
    }
}
