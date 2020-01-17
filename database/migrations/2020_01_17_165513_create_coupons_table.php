<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_name')->require();
            $table->integer('number_of_usage')->reuire();
            $table->time('lifetime')->require();
            $table->float('coupon_persentage')->nullable();
            $table->float('coupon_price')->nullable();
            $table->enum('validate_state',[1,0])->default(1);
            $table->enum('apply_coupon',[1,0])->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
