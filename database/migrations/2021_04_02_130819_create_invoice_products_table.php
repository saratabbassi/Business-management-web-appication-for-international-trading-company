<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_id'); // $invoice_product->size
            $table->string('product_id' );
            $table->string('size_id'); 
            $table->unsignedInteger('quantity');
            $table->decimal('total_price');
            $table->decimal('unit_price');
            $table->decimal('weight');
            $table->decimal('total_weight');
            $table->decimal('buying_price');
            $table->decimal('benefice');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_products');
    }
}
