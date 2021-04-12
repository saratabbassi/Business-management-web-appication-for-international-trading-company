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
            $table->bigIncrements('id');
            $table->string('last_invoice_no')->unique();
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');
            $table->string('devise');
            $table->string('customer_name');
            $table->string('customer_adress');
            $table->string('company_name');
            $table->string('company_adress');
            $table->string('company_phone');
            $table->decimal('poids_brut');
            $table->decimal('poids_net');
            $table->string('livraison');   
            $table->string('incoterm');   
            $table->string('payment_details');
            $table->string('sub_total');
            $table->string('shipping');
            $table->string('total_due');
            $table->string('created_by',999);
             


                



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
        Schema::dropIfExists('invoices');
    }
}
