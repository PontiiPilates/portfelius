<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    public function multiplicators(Request $request)
    {
        $response = Http::get(route('backend.multiplicators'), $request);

        $meta = [
            'title' => 'Мультипликаторы',
            'description' => 'Основные финансовые показатели акций российских компаний',
            'keywords' => 'мультипликатор, акции российских компаний',
        ];

        return view('frontend.pages.multiplicators', [
            'dto' => $response->object(),
            'meta' => $meta,
        ]);
    }
}
