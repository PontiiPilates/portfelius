@extends('frontend.layout')

@section('title', $meta['title'])
@section('description', $meta['description'])

@section('content')

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-gray-200">Ticker</th>
                    <th class="border-gray-200">Year</th>
                    <th @if (request()->sort_by == 'revenue') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'revenue']) }}">Revenue @if (request()->sort_by == 'revenue')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">млрд руб</small>
                    </th>
                    <th @if (request()->sort_by == 'net_income') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'net_income']) }}">Net Income @if (request()->sort_by == 'net_income')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">млрд руб</small>
                    </th>
                    <th @if (request()->sort_by == 'operating_income') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'operating_income']) }}">Operating Income
                            @if (request()->sort_by == 'operating_income')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">млрд руб</small>
                    </th>
                    <th @if (request()->sort_by == 'net_debt') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'net_debt']) }}">Net Debt @if (request()->sort_by == 'net_debt')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">млрд руб</small>
                    </th>
                    <th @if (request()->sort_by == 'ebitda') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'ebitda']) }}">EBITDA @if (request()->sort_by == 'ebitda')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">млрд руб</small>
                    </th>
                    <th @if (request()->sort_by == 'net_debt_ebitda') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'net_debt_ebitda']) }}">Net Debt/EBITDA
                            @if (request()->sort_by == 'net_debt_ebitda')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">лет</small>
                    </th>
                    <th @if (request()->sort_by == 'net_margin') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'net_margin']) }}">Net Margin
                            @if (request()->sort_by == 'net_margin')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">%</small>
                    </th>
                    <th @if (request()->sort_by == 'roe') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'roe']) }}">ROE @if (request()->sort_by == 'roe')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">коэф</small>
                    </th>
                    <th @if (request()->sort_by == 'p_e') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'p_e']) }}">P/E @if (request()->sort_by == 'p_e')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">коэф</small>
                    </th>
                    <th @if (request()->sort_by == 'p_s') style="background-color: #f8f9fa" @endif class="border-gray-200">
                        <a href="{{ route('frontend.multiplicators', ['sort_by' => 'p_s']) }}">P/S @if (request()->sort_by == 'p_s')
                                <span style="color: #EF816B">▼</span>
                            @endif
                        </a>
                        <br><small style="color: #9CA3AF">коэф</small>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dto->pager->data as $row)
                    <tr>
                        <td><span class="fw-bold">{{ $row->company->ticker }}</span></td>
                        <td><span class="fw-normal">{{ $row->year }}</span></td>
                        <td @if (request()->sort_by == 'revenue') style="background-color: #f8f9fa" @endif>
                            @if ($row->revenue)
                                <span class="fw-normal">{{ $row->revenue }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        </td>
                        <td @if (request()->sort_by == 'net_income') style="background-color: #f8f9fa" @endif>
                            @if ($row->net_income)
                                <span class="fw-normal">{{ $row->net_income }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'operating_income') style="background-color: #f8f9fa" @endif>
                            @if ($row->operating_income)
                                <span class="fw-normal">{{ $row->operating_income }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'net_debt') style="background-color: #f8f9fa" @endif>
                            @if ($row->net_debt)
                                <span class="fw-normal">{{ $row->net_debt }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'ebitda') style="background-color: #f8f9fa" @endif>
                            @if ($row->ebitda)
                                <span class="fw-normal">{{ $row->ebitda }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'net_debt_ebitda') style="background-color: #f8f9fa" @endif>
                            @if ($row->net_debt_ebitda)
                                <span class="fw-normal">{{ $row->net_debt_ebitda }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'net_margin') style="background-color: #f8f9fa" @endif>
                            @if ($row->net_margin)
                                <span class="fw-normal">{{ $row->net_margin }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'roe') style="background-color: #f8f9fa" @endif>
                            @if ($row->roe)
                                <span class="fw-normal">{{ $row->roe }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'p_e') style="background-color: #f8f9fa" @endif>
                            @if ($row->p_e)
                                <span class="fw-normal">{{ $row->p_e }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                        <td @if (request()->sort_by == 'p_s') style="background-color: #f8f9fa" @endif>
                            @if ($row->p_s)
                                <span class="fw-normal">{{ $row->p_s }}</span>
                            @else
                                <span class="fw-bold text-warning">н/д</span>
                            @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pager --}}
        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    @foreach ($dto->pager->links as $link)
                        @php
                            if (count(request()->all())) {
                                $page = url()->full() . '&' . strstr($link->url, 'page');
                            } else {
                                $page = url()->full() . '?' . strstr($link->url, 'page');
                            }
                        @endphp
                        <li
                            class="page-item @if ($link->active) {{ 'active' }} @endif @if (!$link->url) {{ 'disabled' }} @endif">
                            <a class="page-link" href="{{ $page }}">{!! str_replace(['Previous', 'Next'], ['Назад', 'Вперёд'], $link->label) !!}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="fw-normal small mt-4 mt-lg-0"><b>{{ $dto->pager->current_page }}</b> из
                <b>{{ $dto->pager->last_page }}</b>
            </div>
        </div>
        {{-- Pager --}}
    </div>
@endsection
