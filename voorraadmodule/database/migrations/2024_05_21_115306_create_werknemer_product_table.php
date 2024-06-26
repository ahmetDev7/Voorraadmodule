<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWerknemerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('werknemer_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('werknemer_id')->constrained()->onDelete('cascade');
            $table->foreignId('serialnumber_id')->constrained(table: 'product_serial_numbers')->onDelete('cascade');
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
        Schema::dropIfExists('werknemer_product');
    }
}

