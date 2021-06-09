<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->uuid('product_id')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->integer("amount");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("product_id")->references('uuid')->on('product_variants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign("user_id")->references('uuid')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
