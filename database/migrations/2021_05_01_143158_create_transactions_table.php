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
            $table->uuid('uuid');
            $table->text('product');
            $table->uuid('user_id')->nullable(false);
            $table->uuid('bank_id')->nullable(false);
            $table->uuid('transfer_evidence')->nullable();
            $table->text("atas_nama");
            $table->text("alamat");
            $table->string("province_id");
            $table->string("city_id");
            $table->string("kodepos");
            $table->string("nohp");
            $table->integer("berat");
            $table->datetime("delivered_on")->nullable();
            $table->datetime("canceled_on")->nullable();
            $table->integer("ongkir_id")->nullable();
            $table->string("kurir");
            $table->text("note")->nullable();
            $table->integer("status");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("bank_id")->references('uuid')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign("transfer_evidence")->references('uuid')->on('files')->onUpdate('cascade')->onDelete('cascade');
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
