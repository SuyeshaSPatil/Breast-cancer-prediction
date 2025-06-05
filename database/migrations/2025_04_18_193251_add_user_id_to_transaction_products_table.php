<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('transaction_products', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(); // Add user_id column
    });
}

public function down()
{
    Schema::table('transaction_products', function (Blueprint $table) {
        $table->dropColumn('user_id'); // Remove user_id column if migration is rolled back
    });
}

};
