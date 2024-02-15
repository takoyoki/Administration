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
        Schema::create('serviceorders', function (Blueprint $table) {
            $table->id();
            $table->string('repair_number')->unique(); // 修理伝票番号
            $table->date('scheduled_date'); // 修理予定日
            $table->string('status')->default(\App\Enums\ServiceOrders::EstimatePending); // ステータス
            $table->text('memo')->nullable(); // メモ
            $table->decimal('amount', 10, 2); // 金額
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
        Schema::dropIfExists('serviceorders');
    }
};
