@extends('frontend.layout')

@section('title', $meta['title'])
@section('description', $meta['description'])

@section('content')

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'ticker']) }}">Ticker</a></th>
                    <th class="border-gray-200">Year</th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'revenue']) }}">Revenue</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'net_income']) }}">Net Income</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'operating_income']) }}">Operating Income</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'net_debt']) }}">Net Debt</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'ebitda']) }}">EBITDA</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'net_debt_ebitda']) }}">Net Debt/EBITDA</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'net_income_revenue']) }}">Net Income/Revenue</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'roe']) }}">ROE</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'p_e']) }}">P/E</a></th>
                    <th class="border-gray-200"><a href="{{ route('m', ['sort_by' => 'p_s']) }}">P/S</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dto->data as $row)
                <tr>
                    {{-- <td><span class="fw-bold text-warning">Warning</span></td> --}}
                    {{-- <td><span class="fw-bold">Bold</span></td> --}}

                    <td><span class="fw-bold">{{ $row->ticker }}</span></td>
                    <td><span class="fw-normal">{{ $row->year }}</span></td>
                    <td><span class="fw-normal">{{ $row->revenue }}</span></td>
                    <td><span class="fw-normal">{{ $row->net_income }}</span></td>
                    <td><span class="fw-normal">{{ $row->operating_income }}</span></td>
                    <td><span class="fw-normal">{{ $row->net_debt }}</span></td>
                    <td><span class="fw-normal">{{ $row->ebitda }}</span></td>
                    <td><span class="fw-normal">{{ $row->net_debt_ebitda }}</span></td>
                    <td><span class="fw-normal">{{ $row->net_income_revenue }}</span></td>
                    <td><span class="fw-normal">{{ $row->roe }}</span></td>
                    <td><span class="fw-normal">{{ $row->p_e }}</span></td>
                    <td><span class="fw-normal">{{ $row->p_s }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pager --}}
        {{-- <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    <li class="page-item">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <div class="fw-normal small mt-4 mt-lg-0">Showing <b>5</b> out of <b>25</b> entries</div>
        </div> --}}
        {{-- Pager --}}
    </div>
@endsection
