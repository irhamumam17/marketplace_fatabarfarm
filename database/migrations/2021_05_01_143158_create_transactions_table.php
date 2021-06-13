<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->uuid('product_id')->nullable(false);
            $table->uuid('user_id')->nullable(false);
            $table->uuid('bank_id')->nullable(false);
            $table->uuid('transfer_evidence')->nullable(false);
            $table->text("ongkir");
            $table->integer("amount");
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("bank_id")->references('uuid')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign("transfer_evidence")->references('uuid')->on('files')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
