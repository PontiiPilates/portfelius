<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Multiplicator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class MsfoController extends Controller
{
    public function multiplicators(Request $request)
    {
        // если не выбран тип сортировки
        $request->sort_by
            ? $sortBy = $request->sort_by
            : $sortBy = 'revenue';

        // если не выбран год
        $request->year
            ? $year = $request->year
            : $year = now()->subYear()->isoFormat('YYYY');

        $multiplicators = Multiplicator::query()
            ->whereHas('company', function (Builder $query) {
                $query->where('is_bad', false);
            })
            ->where('year', $year)
            ->orderByDesc($sortBy)
            ->paginate(10);

        foreach ($multiplicators as $row) {
            $data[] = [
                'ticker' => $row->company->ticker,
                'year' => $row->year,
                'revenue' => $row->revenue,
                'net_income' => $row->net_income,
                'operating_income' => $row->operating_income,
                'net_debt' => $row->net_debt,
                'ebitda' => $row->ebitda,
                'net_debt_ebitda' => $row->net_debt_ebitda,
                'net_margin' => $row->net_margin,
                'roe' => $row->roe,
                'p_e' => $row->p_e,
                'p_s' => $row->p_s,
            ];
        }

        return response()->json([
            'success' => true,
            'errors' => [],
            'pager' => $multiplicators,
        ]);
    }

    public function dividendStocks()
    {
        return response()->json([
            'success' => true,
            'data' => ['some' => 'data'],
        ]);
    }

    public function growthStocks(Request $request)
    {
        $request->has('revenue')
            ? $filterRevenue5Yrs = $request->revenue
            : $filterRevenue5Yrs = 10;
        $request->has('net_income')
            ? $filterNetIncome5Yrs = $request->net_income
            : $filterNetIncome5Yrs = 10;
        $request->has('operating_income')
            ? $filterOperatingIncome5Yrs = $request->operating_income
            : $filterOperatingIncome5Yrs = 10;
        $request->has('net_margin')
            ? $filterNetMargin = $request->net_margin
            : $filterNetMargin = 10;
        $request->has('p_e')
            ? $filterPE = $request->p_e
            : $filterPE = 10;
        $request->has('p_s')
            ? $filterPS = $request->p_s
            : $filterPS = 2;
        $request->has('sector')
            ? $filterSector = $request->sector
            : $filterSector = '';
        $request->has('net_debt_ebitda')
            ? $filterNetDebtEbitda = $request->net_debt_ebitda
            : $filterNetDebtEbitda = 3;
        $request->has('sort_by')
            ? $filterSortBy = $request->sort_by
            : $filterSortBy = "ticker";

        $startYear = now()->subYear(5)->isoFormat('YYYY');
        $currentYear = now()->subYear()->isoFormat('YYYY');

        $companies = Company::query()
            ->select('companies.ticker', 'companies.name', 'companies.sector')
            ->join('multiplicators as current', function (JoinClause $join) {
                $join->on('companies.id', '=', 'current.company_id')
                    ->where([
                        ['current.year', '=', 2024],
                    ]);
            })
            ->join('multiplicators as history', function (JoinClause $join) {
                $join->on('companies.id', '=', 'history.company_id')
                    ->whereBetween('history.year', [2019, 2024]);
            })

            // исключает значения с отсутствующими данными
            // не все поля отфильтровывают отсутствующие данные
            // для этих случаев применается явное ограничение выборки
            ->when($filterNetDebtEbitda, function (Builder $query, string $filterNetDebtEbitda) {
                $query->where('current.net_debt_ebitda', '!=', 0);
            })
            ->when($filterPE, function (Builder $query, string $filterPE) {
                $query->where('current.p_e', '!=', 0);
            })
            ->when($filterPS, function (Builder $query, string $filterPS) {
                $query->where('current.p_s', '!=', 0);
            })

            // вычисление среднего от процентного изменения к предыдущему периоду
            // если значение отсутствует, то есть компания не отчиталась в этом периоде
            // то это не ломает расчёт
            ->selectRaw('(
                SELECT AVG(
                    CASE 
                        WHEN prev_year.revenue > 0 AND next_year.revenue > 0 
                        THEN (next_year.revenue - prev_year.revenue) / NULLIF(prev_year.revenue, 0) * 100
                    END
                )
                FROM multiplicators as prev_year
                JOIN multiplicators as next_year ON (
                    prev_year.company_id = next_year.company_id AND
                    next_year.year = (
                        SELECT MIN(year) FROM multiplicators 
                        WHERE company_id = prev_year.company_id 
                        AND year > prev_year.year
                        AND year <= 2024
                    )
                )
                WHERE prev_year.company_id = companies.id
                AND prev_year.year BETWEEN 2019 AND 2023
            ) as revenue_growth_5_yrs')

            ->selectRaw('(
                SELECT AVG(
                    CASE 
                        WHEN prev_year.net_income > 0 AND next_year.net_income > 0 
                        THEN (next_year.net_income - prev_year.net_income) / NULLIF(prev_year.net_income, 0) * 100
                    END
                )
                FROM multiplicators as prev_year
                JOIN multiplicators as next_year ON (
                    prev_year.company_id = next_year.company_id AND
                    next_year.year = (
                        SELECT MIN(year) FROM multiplicators 
                        WHERE company_id = prev_year.company_id 
                        AND year > prev_year.year
                        AND year <= 2024
                    )
                )
                WHERE prev_year.company_id = companies.id
                AND prev_year.year BETWEEN 2019 AND 2023
            ) as net_income_growth_5_yrs')

            ->selectRaw('(
                SELECT AVG(
                    CASE 
                        WHEN prev_year.operating_income > 0 AND next_year.operating_income > 0 
                        THEN (next_year.operating_income - prev_year.operating_income) / NULLIF(prev_year.operating_income, 0) * 100
                    END
                )
                FROM multiplicators as prev_year
                JOIN multiplicators as next_year ON (
                    prev_year.company_id = next_year.company_id AND
                    next_year.year = (
                        SELECT MIN(year) FROM multiplicators 
                        WHERE company_id = prev_year.company_id 
                        AND year > prev_year.year
                        AND year <= 2024
                    )
                )
                WHERE prev_year.company_id = companies.id
                AND prev_year.year BETWEEN 2019 AND 2023
            ) as operating_income_growth_5_yrs')

            ->selectRaw('AVG(history.net_margin) as net_margin_growth_5_yrs')
            ->selectRaw('AVG(current.net_debt_ebitda) as net_debt_ebitda')
            ->selectRaw('AVG(current.p_e) as p_e')
            ->selectRaw('AVG(current.p_s) as p_s')

            ->groupBy('history.company_id')

            // фильтрация, если есть параметр запроса
            ->when($filterRevenue5Yrs, function (Builder $query, string $filterRevenue5Yrs) {
                $query->having('revenue_growth_5_yrs', '>', $filterRevenue5Yrs);
            })
            ->when($filterNetIncome5Yrs, function (Builder $query, string $filterNetIncome5Yrs) {
                $query->having('net_income_growth_5_yrs', '>', $filterNetIncome5Yrs);
            })
            ->when($filterOperatingIncome5Yrs, function (Builder $query, string $filterOperatingIncome5Yrs) {
                $query->having('operating_income_growth_5_yrs', '>', $filterOperatingIncome5Yrs);
            })
            ->when($filterNetDebtEbitda, function (Builder $query, string $filterNetDebtEbitda) {
                $query->having('net_debt_ebitda', '<', $filterNetDebtEbitda);
            })
            ->when($filterNetMargin, function (Builder $query, string $filterNetMargin) {
                $query->having('net_margin_growth_5_yrs', '>', $filterNetMargin);
            })
            ->when($filterPE, function (Builder $query, string $filterPE) {
                $query->having('p_e', '<', $filterPE);
            })
            ->when($filterPS, function (Builder $query, string $filterPS) {
                $query->having('p_s', '<', $filterPS);
            })
            ->when($filterNetDebtEbitda, function (Builder $query, string $filterNetDebtEbitda) {
                $query->having('net_debt_ebitda', '<', $filterNetDebtEbitda);
            })

            ->when($filterPS, function (Builder $query, string $filterPS) {
                $query->having('p_s', '<', $filterPS);
            })

            ->when($filterNetDebtEbitda, function (Builder $query, string $filterNetDebtEbitda) {
                $query->having('net_debt_ebitda', '<', $filterNetDebtEbitda);
            })
            ->when($filterSector, function (Builder $query, string $filterSector) {
                $query->having('companies.sector', $filterSector);
            })
            ->when($filterSortBy, function (Builder $query, string $filterSortBy) {
                $query->orderByDesc($filterSortBy);
            })

            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }
}
