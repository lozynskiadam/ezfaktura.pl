<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatureEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signature_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signature_id')->references('id')->on('signatures')->onDelete('cascade');
            $table->string('value');
            $table->date('date');
            $table->tinyInteger('counter');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('signature_entry_id')->nullable()->after('invoice_type_id')->references('id')->on('signature_entries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('signature_entry_id');
        });
        Schema::dropIfExists('signature_entries');
    }
}
