<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('operator_name');
            $table->string('contact_number');
            $table->string('secondary_number');
            $table->string('address');
            $table->date('dob');
            $table->string('aadhaar_number');
            $table->string('licence');
            $table->string('agreement');
            $table->string('gstin_number');
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
        Schema::dropIfExists('operators');
    }
}
