<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatureInvoiceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signature_invoice_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signature_id')->references('id')->on('signatures')->onDelete('cascade');
            $table->foreignId('invoice_type_id')->references('id')->on('invoice_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signature_invoice_type');
    }
}
