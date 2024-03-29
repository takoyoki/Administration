<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('repair_number')->unique(); // 修理伝票番号
            $table->date('scheduled_date'); // 修理予定日
            $table->string('status')->default(\App\Enums\ServiceOrderStatus::EstimatePending); // ステータス
            $table->string('customer_name')->nullable()->comment('依頼様名'); // 顧客名
            $table->string('phone_number')->nullable()->comment('電話番号'); // 電話番号
            $table->string('address')->nullable()->comment('住所'); // 住所
            $table->text('memo')->nullable()->comment('伝票メモ'); // メモ
            $table->text('service_request')->nullable()->comment('依頼内容'); // メモ
            $table->text('repair_assessment_and_implementation')->nullable()->comment('判定実施内容'); // メモ
            $table->decimal('amount', 10, 2)->default(0.00)->comment('料金（円）'); // 金額
            $table->timestamps(); // 作成日時、更新日時
            $table->softDeletes(); // ソフトデリート
            $table->foreignId('worker_id')->nullable()->constrained('workers');
        });
    }

    /**
     * マイグレーションを戻します。
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_orders');
    }
};