<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id')->unique();
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->date('date')->default(DB::raw('NOW()'));
            $table->boolean('status')->default(true);
            $table->string('transaction_id')->unique();
            $table->foreign('transaction_id')->references('transaction_id')->on('payments');
            // $table->foreign('advertisement_id')->references('id')->on('advertisements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
