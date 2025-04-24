<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    public function m(Request $request)
    {
        $response = Http::get(route('msfo'), $request->sort_by);
        return view('frontend.pages.multiplicators', [
            'dto' => $response->object(),
            'meta' => [
                'title' => 'Мультипликаторы',
                'description' => 'Основные финансовые показатели акций российских компаний',
                'keywords' => 'мультипликатор, акции российских компаний',
            ]
        ]);
    }
}
