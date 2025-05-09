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
                <a href="#" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img class="icon icon-xs" src="/assets/img/brand/light.svg" height="20" width="20" alt="logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text display-5"><b>{{ env('APP_NAME') }}</b></span>
                </a>
            </li>
            {{-- Home --}}

            {{-- Primary parameters --}}
            <li class="nav-item">
                <a href="{{ route('frontend.primaryParameters', ['year' => now()->subYear()->isoFormat('YYYY'), 'sort_by' => 'revenue']) }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Основные показатели</span>
                </a>
            </li>
            {{-- Primary parameters --}}

            {{-- Growth --}}
            <li class="nav-item">
                <a href="{{ route('frontend.growthStocks') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M12.17 9.53c2.307-2.592 3.278-4.684 3.641-6.218.21-.887.214-1.58.16-2.065a3.6 3.6 0 0 0-.108-.563 2 2 0 0 0-.078-.23V.453c-.073-.164-.168-.234-.352-.295a2 2 0 0 0-.16-.045 4 4 0 0 0-.57-.093c-.49-.044-1.19-.03-2.08.188-1.536.374-3.618 1.343-6.161 3.604l-2.4.238h-.006a2.55 2.55 0 0 0-1.524.734L.15 7.17a.512.512 0 0 0 .433.868l1.896-.271c.28-.04.592.013.955.132.232.076.437.16.655.248l.203.083c.196.816.66 1.58 1.275 2.195.613.614 1.376 1.08 2.191 1.277l.082.202c.089.218.173.424.249.657.118.363.172.676.132.956l-.271 1.9a.512.512 0 0 0 .867.433l2.382-2.386c.41-.41.668-.949.732-1.526zm.11-3.699c-.797.8-1.93.961-2.528.362-.598-.6-.436-1.733.361-2.532.798-.799 1.93-.96 2.528-.361s.437 1.732-.36 2.531Z" />
                            <path d="M5.205 10.787a7.6 7.6 0 0 0 1.804 1.352c-1.118 1.007-4.929 2.028-5.054 1.903-.126-.127.737-4.189 1.839-5.18.346.69.837 1.35 1.411 1.925" />
                        </svg>
                    </span>
                    <span class="sidebar-text">Акции роста</span>
                </a>
            </li>
            {{-- Growth --}}

            {{-- Dividend --}}
            <li class="nav-item">
                <a href="{{ route('frontend.dividendStocks') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 20 20">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5" />
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z" />
                        </svg>
                    </span>
                    <span class="sidebar-text">Дивидендные акции</span>
                </a>
            </li>
            {{-- Dividend --}}

            {{-- Multiplicators --}}
            <li class="nav-item">
                <a href="{{ route('frontend.multiplicators') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 20 20">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
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
