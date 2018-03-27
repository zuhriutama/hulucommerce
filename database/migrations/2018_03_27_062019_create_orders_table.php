<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial')->unique();
            $table->integer('user_id');
            $table->integer('cart_id');
            $table->integer('payment_address_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->enum('payment_status', ['unpaid', 'waiting', 'paid', 'reject', 'cancel'])->default('unpaid');
            $table->datetime('paid_at')->nullable();
            $table->integer('shipping_address_id')->nullable();
            $table->integer('shipping_method_id')->nullable();
            $table->enum('shipping_status', ['undelivered', 'delivered', 'received', 'return'])->default('undelivered');
            $table->float('shipping_cost', 15, 2)->default(0);
            $table->string('tracking_no')->nullable();
            $table->string('note', 250)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
