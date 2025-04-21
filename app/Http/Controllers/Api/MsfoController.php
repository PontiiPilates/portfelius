<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Multiplicator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MsfoController extends Controller
{
    public function msfo(Request $request)
    {
        $request->sort_by
            ? $sortBy = $request->sort_by
            : $sortBy = 'revenue';

        $multiplicators = Multiplicator::query()
            ->whereHas('company', function (Builder $query) {
                $query->where('is_bad', false);
            })
            ->where('year', 2024)
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
            'data' => $data,
        ]);
    }
}
