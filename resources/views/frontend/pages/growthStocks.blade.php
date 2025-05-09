@extends('frontend.layout')

@section('title', $meta['title'])
@section('description', $meta['description'])
@section('keywords', $meta['keywords'])

@section('content')

    @php
        $sectors = \App\Models\Company::select('sector')->groupBy('sector')->orderBy('sector')->get();
    @endphp


    <div class="row">

        {{-- Filter --}}
        <div class="col-12 col-xxl-8">
            <div class="card card-body border-0 shadow mb-4">
                <form method="GET" action="{{ route('frontend.growthStocks') }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="revenue" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост выручки за последние 5 лет">
                                    Revenue<small style="color: #9CA3AF">, 5 yrs</small></label>
                                <select class="form-select mb-0" id="revenue" name="revenue" aria-label="Revenue Growth, 5 yrs">
                                    <option value="0">---</option>
                                    @foreach (range(5, 100, 5) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('revenue') == $value || (!request()->has('revenue') && $value == 10))>больше {{ $value }}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="net_income" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост чистой прибыли за последние 5 лет">
                                    Net Income<small style="color: #9CA3AF">, 5 yrs</small></label>
                                <select class="form-select mb-0" id="net_income" name="net_income" aria-label="Net Income Growth, 5 yrs">
                                    <option value="0">---</option>
                                    @foreach (range(5, 100, 5) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('net_income') == $value || (!request()->has('net_income') && $value == 10))>больше {{ $value }}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="operating_income" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост операционной прибыли за последние 5 лет">
                                    Operating Income<small style="color: #9CA3AF">, 5 yrs</small></label>
                                <select class="form-select mb-0" id="operating_income" name="operating_income" aria-label="Operating Income Growth, 5 yrs">
                                    <option value="0">---</option>
                                    @foreach (range(5, 100, 5) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('operating_income') == $value || (!request()->has('operating_income') && $value == 10))>больше {{ $value }}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="net_margin" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост чистой маржинальности за последние 5 лет">
                                    Net Margin<small style="color: #9CA3AF">, 5 yrs</small></label>
                                <select class="form-select mb-0" id="net_margin" name="net_margin" aria-label="Net Margin, 5 yrs">
                                    <option value="0">---</option>
                                    @foreach (range(5, 100, 5) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('net_margin') == $value || (!request()->has('net_margin') && $value == 10))>больше {{ $value }}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="p_e" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение рыночной цены акции к чистой прибыли на акцию">P/E</label>
                                <select class="form-select mb-0" id="p_e" name="p_e" aria-label="P/S">
                                    <option value="99999">---</option>
                                    @foreach (range(1, 20, 1) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('p_e') == $value || (!request()->has('p_e') && $value == 10))>меньше {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="p_s" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение рыночной капитализации компании к её выручке">P/S</label>
                                <select class="form-select mb-0" id="p_s" name="p_s" aria-label="P/S">
                                    <option value="99999">---</option>
                                    @foreach (range(1, 10, 1) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('p_s') == $value || (!request()->has('p_s') && $value == 2))>меньше {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="net_debt_ebitda" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение долга компании к её EBITDA">Net Debt/EBITDA</label>
                                <select class="form-select mb-0" id="net_debt_ebitda" name="net_debt_ebitda" aria-label="Net Debt/Ebitda">
                                    <option value="99999">---</option>
                                    @foreach (range(1, 5, 1) as $value)
                                        <option value="{{ $value }}" @selected(request()->input('net_debt_ebitda') == $value || (!request()->has('net_debt_ebitda') && $value == 3))>меньше {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="sector" data-bs-toggle="tooltip" data-bs-placement="top" title="Экономический сектор компании">Sector</label>
                                <select class="form-select mb-0" id="sector" name="sector" aria-label="P/S">
                                    <option value="">---</option>
                                    @foreach ($sectors as $item)
                                        <option value="{{ $item->sector }}" @selected(request()->input('sector') == $item->sector)> {{ $item->sector }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Применить</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Filter --}}

        {{-- Widget --}}
        <div class="d-none d-xxl-block col-xxl-4 ">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 p-0">
                        <div class="card-body">
                            <p>Особенность фильтра в том, что он позволяет анализировать компании одновременно по <b>средним
                                    значениям за 5 лет</b> и <b>тукущим показателям</b>.</p>
                            <p>Фильт уже сипользует рекомендованные настройки.</p>
                            <p>Изучайте <b><a href="/help" class="text-secondary">описание мультипликаторов</a></b>,
                                экспериментируйте с настройками, сравнивайте компании по секторам.</p>
                            <p>Смягчайте настройки фильтра или делайте их строже, в зависимости от своих целей.</p>
                            <p>Выбор компании предполагает самостоятельное более детальное ее изучение.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Widget --}}

    </div>

    @php
        // поставляет параметры запроса для обеспечения фильтрации
        $queryParams = request()->except(['sort_by', 'page']);
    @endphp

    <div class="card card-body border-0 shadow table-wrapper table-responsive mt-4">
        <table class="table table-hover">

            {{-- Headers --}}
            <thead>
                <tr>
                    <th class="border-gray-200" >
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Код инструмента">Ticker</span>
                    </th>

                    <th @if (request()->sort_by == 'revenue_growth_5_yrs') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'revenue_growth_5_yrs'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост выручки за последние 5 лет">
                            Revenue
                            @if (request()->sort_by == 'revenue_growth_5_yrs')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'net_income_growth_5_yrs') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'net_income_growth_5_yrs'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост чистой прибыли за последние 5 лет">
                            Net Income
                            @if (request()->sort_by == 'net_income_growth_5_yrs')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'operating_income_growth_5_yrs') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'operating_income_growth_5_yrs'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост операционной прибыли за последние 5 лет">
                            Operating Income
                            @if (request()->sort_by == 'operating_income_growth_5_yrs')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'net_margin_growth_5_yrs') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'net_margin_growth_5_yrs'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Рост чистой маржинальности за последние 5 лет">
                            Net Margin
                            @if (request()->sort_by == 'net_margin_growth_5_yrs')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'net_debt_ebitda') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'net_debt_ebitda'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение долга компании к её EBITDA">
                            Net Debt/EBITDA
                            @if (request()->sort_by == 'net_debt_ebitda')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'p_e') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'p_e'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение рыночной цены акции к чистой прибыли на акцию">
                            P/E
                            @if (request()->sort_by == 'p_e')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'p_s') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'p_s'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Соотношение рыночной капитализации компании к её выручке">
                            P/S
                            @if (request()->sort_by == 'p_s')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                    <th @if (request()->sort_by == 'sector') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.growthStocks', array_merge($queryParams, ['sort_by' => 'sector'])) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Экономический сектор компании">
                            Sector
                            @if (request()->sort_by == 'sector')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            {{-- Headers --}}

            {{-- Data --}}
            <tbody>
                @foreach ($data->data->data as $company)
                    <tr>
                        <td>
                            <span class="fw-bold">{{ $company->ticker }}</span>
                        </td>
                        <td @if (request()->sort_by == 'revenue_growth_5_yrs') style="background-color: #f8f9fa" @endif>
                            @if ($company->revenue_growth_5_yrs)
                                <span class="fw-normal">{{ round($company->revenue_growth_5_yrs, 2) }} <small style="color: #9CA3AF">%</small></span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>
                        <td @if (request()->sort_by == 'net_income_growth_5_yrs') style="background-color: #f8f9fa" @endif>
                            @if ($company->net_income_growth_5_yrs)
                                <span class="fw-normal">{{ round($company->net_income_growth_5_yrs, 2) }} <small style="color: #9CA3AF">%</small></span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'operating_income_growth_5_yrs') style="background-color: #f8f9fa" @endif>
                            @if ($company->operating_income_growth_5_yrs)
                                <span class="fw-normal">{{ round($company->operating_income_growth_5_yrs), 2 }} <small style="color: #9CA3AF">%</small></span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'net_margin_growth_5_yrs') style="background-color: #f8f9fa" @endif>
                            @if ($company->net_margin_growth_5_yrs)
                                <span class="fw-normal">{{ round($company->net_margin_growth_5_yrs, 2) }} <small style="color: #9CA3AF">%</small></span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'net_debt_ebitda') style="background-color: #f8f9fa" @endif>
                            @if ($company->net_debt_ebitda)
                                <span class="fw-normal">{{ $company->net_debt_ebitda }} <small style="color: #9CA3AF">yrs</small></span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'p_e') style="background-color: #f8f9fa" @endif>
                            @if ($company->p_e)
                                <span class="fw-normal">{{ $company->p_e }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'p_s') style="background-color: #f8f9fa" @endif>
                            @if ($company->p_s)
                                <span class="fw-normal">{{ $company->p_s }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>

                        <td @if (request()->sort_by == 'sector') style="background-color: #f8f9fa" @endif>
                            @if ($company->sector)
                                <span class="fw-normal">{{ $company->sector }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>


                    </tr>
                @endforeach
            </tbody>
            {{-- Data --}}
        </table>



        {{-- Pager --}}
        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    @foreach ($data->data->links as $link)
                        @php
                            if (count(request()->all())) {
                                $page = url()->full() . '&' . strstr($link->url, 'page');
                            } else {
                                $page = url()->full() . '?' . strstr($link->url, 'page');
                            }
                        @endphp
                        <li class="page-item @if ($link->active) {{ 'active' }} @endif @if (!$link->url) {{ 'disabled' }} @endif">
                            <a class="page-link" href="{{ $page }}">{!! str_replace(['Previous', 'Next'], ['Назад', 'Вперёд'], $link->label) !!}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="fw-normal small mt-4 mt-lg-0"><b>{{ $data->data->current_page }}</b> из
                <b>{{ $data->data->last_page }}</b>
            </div>
        </div>
        {{-- Pager --}}

    </div>

    {{-- Widget --}}
    <div class="row mt-5">
        <div class="col-12 d-xxl-none">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 p-0">
                        <div class="card-body">
                            <p>Особенность фильтра в том, что он позволяет анализировать компании одновременно по <b>средним
                                    значениям за 5 лет</b> и <b>тукущим показателям</b>.</p>
                            <p>Фильт уже сипользует рекомендованные настройки.</p>
                            <p>Изучайте <b><a href="/help" class="text-secondary">описание мультипликаторов</a></b>,
                                экспериментируйте с настройками, сравнивайте компании по секторам.</p>
                            <p>Смягчайте настройки фильтра или делайте их строже, в зависимости от своих целей.</p>
                            <p>Выбор компании предполагает самостоятельное более детальное ее изучение.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Widget --}}

@endsection
