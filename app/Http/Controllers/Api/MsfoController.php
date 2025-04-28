<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Multiplicator;
use Illuminate\Database\Eloquent\Builder;
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
                'net_income_revenue' => $row->net_income_revenue,
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
}
