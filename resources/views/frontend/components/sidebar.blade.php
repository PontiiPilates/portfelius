{{-- Adaptive navigation --}}
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
        <img class="navbar-brand-dark" src="/assets/img/brand/light.svg" alt="logo" />
        <img class="navbar-brand-light" src="/assets/img/brand/dark.svg" alt="logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
{{-- Adaptive navigation --}}

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">

        {{-- Sidebar Menu --}}
        <ul class="nav flex-column pt-3 pt-md-0">

            {{-- Home --}}
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="/assets/img/brand/light.svg" height="20" width="20" alt="logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text">{{ env('APP_NAME') }}</span>
                </a>
            </li>
            {{-- Home --}}

            {{-- Multiplicators --}}
            <li class="nav-item ">
                <a href="{{ route('frontend.multiplicators', ['year' => now()->subYear()->isoFormat('YYYY'), 'sort_by' => 'revenue']) }}"
                    class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Мультипликаторы</span>
                </a>
            </li>
            {{-- Multiplicators --}}

        </ul>
        {{-- Sidebar Menu --}}
    </div>
</nav>
