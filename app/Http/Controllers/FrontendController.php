<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    public function primaryParameters(Request $request)
    {
        $response = Http::get(route('backend.multiplicators'), $request);

        $meta = [
            'title' => 'Мультипликаторы',
            'description' => 'Основные финансовые показатели акций российских компаний',
            'keywords' => 'мультипликатор, акции российских компаний',
        ];

        return view('frontend.pages.primary-parameters', [
            'dto' => $response->object(),
            'meta' => $meta,
        ]);
    }

    public function dividendStocks(Request $request)
    {
        $response = Http::get(route('backend.dividendStocks'), $request);

        $meta = [
            'title' => 'Дивидендные акции',
            'description' => 'Фильтр позволяет выбирать акции российских компаний с ориентиром на доходность от дивидендов',
            'keywords' => 'дивидендные акции, фильтр дивидендных аккций',
        ];

        return view('frontend.pages.dividendStocks', [
            "data" => $response->object(),
            'meta' => $meta,
        ]);
    }

    public function growthStocks(Request $request)
    {
        $response = Http::get(route('backend.growthStocks'), $request);

        $meta = [
            'title' => 'Акции роста',
            'description' => 'Фильтр позволяет выбирать российские акции с повышенным потенциалом роста',
            'keywords' => 'ростовые акции, акции роста, скринер акций, скринер российских акций, фильтр акций, фильтр российских акций',
        ];

        return view('frontend.pages.growthStocks', [
            'data' => $response->object(),
            'meta' => $meta,
        ]);
    }

    public function multiplicators(Request $request)
    {
        $meta = [
            'title' => 'Мультипликаторы',
            'description' => 'Краткое описание основных мультипликаторов',
            'keywords' => 'revenue, выручка, net income, чистая прибыль',
        ];

        return view('frontend.pages.multiplicators', [
            'meta' => $meta,
        ]);
    }
}
