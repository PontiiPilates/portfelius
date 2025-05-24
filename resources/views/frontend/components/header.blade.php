<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        @if (request()->url() != route('frontend.home'))
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">@yield('description')</p>
        @endif
    </div>
</div>
