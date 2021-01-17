<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('invoice_type_id')->references('id')->on('invoice_types')->onDelete('cascade');
            $table->foreignId('signature_id')->nullable()->references('id')->on('signatures')->onDelete('cascade');
            $table->string('signature')->nullable();
            $table->date('issue_date');
            $table->date('sale_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('payment_due_date');
            $table->string('payment_method');
            $table->enum('invoicing_mode', ['net', 'gross']);
            $table->enum('currency', ['PLN', 'EUR', 'USD', 'GBP']);
            $table->enum('discount_type', ['VP', 'VA', 'PP', 'PA']);
            $table->enum('language', ['en', 'pl']);
            $table->json('buyer');
            $table->json('seller');
            $table->json('payer')->nullable();
            $table->json('recipient')->nullable();
            $table->json('positions');
            $table->json('tax_summary');
            $table->decimal('tax_total', 16, 2);
            $table->string('tax_total_in_words');
            $table->decimal('net_total', 16, 2);
            $table->string('net_total_in_words');
            $table->decimal('gross_total', 16, 2);
            $table->string('gross_total_in_words');
            $table->text('annotation')->nullable();
            $table->json('additional')->nullable();
            $table->string('file_path', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
