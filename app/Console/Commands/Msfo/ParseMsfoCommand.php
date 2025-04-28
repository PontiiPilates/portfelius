<?php

declare(strict_types=1);

namespace App\Console\Commands\Msfo;

use App\Enums\PrimaryMultiplicatorType;
use App\Models\Company;
use App\Models\Multiplicator;
use Carbon\Carbon;
use Illuminate\Console\Command;
use voku\helper\HtmlDomParser;

class ParseMsfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msfo:parse-msfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Анализирует финансовую отчётность и сохраняет мультипликаторы в таблицу';

    private array $multiplicators = [];
    private HtmlDomParser $dom;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $companies = Company::query()->where('is_bad', false)->get();
        // $companies = Company::query()->where('ticker', "ACKO")->get();

        foreach ($companies as $company) {
            $this->parseMultiplicators($company);
            $this->saveMultiplicators($company);
        }
    }

    private function parseMultiplicators($company)
    {
        $this->dom = HtmlDomParser::file_get_html("C:\OSPanel\domains\portfelius\storage\app\downloads\companies_collection\\$company->ticker.html");

        dump($company->ticker);

        foreach (PrimaryMultiplicatorType::cases() as $multiplicator) {
            $this->addMultiplicator($multiplicator->name);
        }

        $this->multiplicators['available_years'] = $this->prepareYears();
    }

    private function addMultiplicator($multiplicator)
    {
        $rawMultiplicators = $this->dom->find("[field=$multiplicator]")->find('td')?->plaintext;

        // если в документе не обнаружен искомый мультипликатор
        if (!$rawMultiplicators) {
            $this->multiplicators[$multiplicator] = array_fill(0, 10, null);
            return;
        }

        foreach ($rawMultiplicators as $key => $value) {

            $rawMultiplicators[$key] = str_replace([' ', '%'], '', $value);

            if (!$value) {
                $rawMultiplicators[$key] = null;
            }
        }

        $this->multiplicators[$multiplicator] = $rawMultiplicators;
    }


    private function prepareYears(): array
    {
        $years = $this->dom->find(".header_row")->find('td')?->plaintext;

        foreach ($years as $key => $year) {
            if (strstr($year, 'LTM')) {
                $years[$key] = Carbon::now()->isoFormat('YYYY');
            }
        }

        return $years;
    }

    private function saveMultiplicators($company): void
    {
        $this->deleteOldEntries($company);

        foreach ($this->multiplicators["available_years"] as $key => $year) {

            if (!is_numeric($year)) {
                continue;
            }

            $parameters = [
                'company_id' => $company->id,
                'year' => $year,
                'revenue' => $this->multiplicators['revenue'][$key],
                'net_income' => $this->multiplicators['net_income'][$key],
                'operating_income' => $this->multiplicators['operating_income'][$key],
                'net_debt' => $this->multiplicators['net_debt'][$key],
                'ebitda' => $this->multiplicators['ebitda'][$key],
                'net_debt_ebitda' => $this->netDebtEbitda($key),
                'net_income_revenue' => $this->netIncomeRevenue($key),
                'roe' => $this->multiplicators['roe'][$key],
                'p_e' => $this->multiplicators['p_e'][$key],
                'p_s' => $this->multiplicators['p_s'][$key],
            ];

            Multiplicator::create($parameters);
        }
    }

    private function deleteOldEntries($company): void
    {
        Multiplicator::where("company_id", $company->id)->delete();
    }

    /**
     * Коэффициент окупаемости
     */
    private function netDebtEbitda($key)
    {
        // проверка существования ключа
        if (!isset($this->multiplicators['net_debt'][$key]) && !isset($this->multiplicators['ebitda'][$key])) {
            return null;
        }

        $netDebt = $this->multiplicators['net_debt'][$key];
        $ebitda = $this->multiplicators['ebitda'][$key];

        // проверка наличия значения
        if (!$netDebt || !$ebitda) {
            return null;
        }

        // проверка значений на 0
        if ($netDebt == 0 || $ebitda == 0) {
            return null;
        }

        return round(($netDebt / $ebitda), 1);
    }

    /**
     * Чистая маржинальность
     */
    private function netIncomeRevenue($key)
    {
        // проверка существования ключа
        if (!isset($this->multiplicators['net_income'][$key]) && !isset($this->multiplicators['revenue'][$key])) {
            return null;
        }

        $netIncome = $this->multiplicators['net_income'][$key];
        $revenue = $this->multiplicators['revenue'][$key];

        // проверка наличия значения
        if (!$netIncome || !$revenue) {
            return null;
        }

        // проверка значений на 0
        if ($netIncome == 0 || $revenue == 0) {
            return null;
        }

        return round(($netIncome / $revenue * 100), 1);
    }
}
