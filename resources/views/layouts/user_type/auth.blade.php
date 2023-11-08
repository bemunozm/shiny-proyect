@extends('layouts.app')

@section('auth')


    @if(\Request::is('static-sign-up')) 
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')
    
    @elseif (\Request::is('static-sign-in')) 
        @include('layouts.navbars.guest.nav')
            @yield('content')
        @include('layouts.footers.guest.footer')
    
    @else
        @if (\Request::is('rtl'))  
            @include('layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

        @elseif (\Illuminate\Support\Str::startsWith(\Request::path(), 'profile/'))  
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

        @elseif (\Request::is('virtual-reality')) 
            @include('layouts.navbars.auth.nav')
            <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
                @include('layouts.navbars.auth.sidebar')
                <main class="main-content mt-1 border-radius-lg">
                    @yield('content')
                </main>
            </div>
            @include('layouts.footers.auth.footer')

        @elseif (\Request::is('company'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
            
        @elseif (\Request::is('company-profile'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        
            @elseif (\Request::is('user-managment'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

            @elseif (\Request::is('avisos'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

            @elseif (\Request::is('replacement'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

            @elseif (\Request::is('resume'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

            @elseif (\Illuminate\Support\Str::startsWith(\Request::path(), 'remplazos/'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

            @elseif (\Illuminate\Support\Str::startsWith(\Request::path(), 'replacement/'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        
        
        @elseif (\Request::is('user-management'))
            @include('layouts.navbars.auth.companysidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.companynav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>

        @else
            @include('layouts.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.nav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('layouts.footers.auth.footer')
                </div>
            </main>
        @endif

        @include('components.fixed-plugin')
    @endif

    

@endsection