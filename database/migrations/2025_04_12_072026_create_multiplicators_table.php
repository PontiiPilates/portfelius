<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('multiplicators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->year('year')->nullable();

            // финансовые потоки
            $table->double('revenue')->nullable()->comment('выручка');
            $table->double('net_income')->nullable()->comment('чистая прибыль');
            $table->double('operating_income')->nullable()->comment('операционная прибыль');

            // долговая нагрузка
            $table->double('net_debt')->nullable()->comment('чистый долг');
            $table->double('ebitda')->nullable()->comment('ebitda');
            $table->double('net_debt_ebitda')->nullable()->comment('коэффициент окупаемости');

            // рентабильность
            $table->double('net_margin')->nullable()->comment('чистая маржинальность');
            $table->double('roe')->nullable()->comment('roe (%)');

            // показатели стоимости
            $table->double('p_e')->nullable()->comment('p/e');
            $table->double('p_s')->nullable()->comment('p/s');

            // показатели стоимости
            $table->double('dividend_yield')->nullable()->comment('дивидендная доходность');
            $table->double('dividend_payout_ratio')->nullable()->comment('коэффициент выплаты дивидендов');

            // остальные
            // multiplicator1
            // multiplicator2
            // multiplicator3

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiplicators');
    }
};
