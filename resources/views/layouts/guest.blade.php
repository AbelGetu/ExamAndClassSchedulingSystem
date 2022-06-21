<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>

            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>

            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">   

        </head>
    <body>    
            @if (Route::has('login'))
            @endif
            <div class="container py-3">
                <header>
                  <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                     
                      <span class="fs-4">Laravel</span>
                    </a>
              
                    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">                     
                      @auth
                        <a href="{{ url('/home') }}" class="me-3 py-2 text-dark text-decoration-none">Home</a>
                       @else
                        <a href="{{ route('login') }}" class="me-3 py-2 text-dark text-decoration-none">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 me-3 py-2 text-dark text-decoration-none">Register</a>
                        @endif
                    @endauth
                    </nav>
                  </div>
                </header>  
                  <main class="my-4">
                    @yield('content')
                    </main>
      </body>
  </html>
  