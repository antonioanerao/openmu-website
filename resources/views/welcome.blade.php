<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column
                justify-content-between">
        <div>
            <header class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/home') }}" class="ml-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                            <a href="{{ route('character.index') }}" class="ml-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Characters</a>
                            <a class="ml-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="ml-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-3 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </header>

            <div class="container mt-5">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">
                                <h3>Home content</h3>
                                @if($info['state'] == 'Online')
                                    Server Status: <span style="color: green;">Online</span> -
                                @else
                                    Server Status: <span style="color: red;">{{ $info['state'] }}</span> -
                                @endif
                                Total Online: {{ $info['players'] }}

                                @if(config('app.download_client'))
                                    <hr>
                                    <a href="{{ config('app.download_client') }}"><i class="fa fa-download"></i> Download Client</a>
                                @endif

                                @if(config('app.download_launcher'))
                                    <br>
                                    <a href="{{ config('app.download_launcher') }}"><i class="fa fa-download"></i> Download Launcher</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-dark text-center text-white">
          <div class="container p-4 pb-0">
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/antonioanerao/openmu-website" role="button">
                    <i class="fab fa-github"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                    <i class="fab fa-twitter"></i>
                </a>
            </section>
          </div>

          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © {{ date('Y') }} Copyright:
              <a class="text-white" href="{{ config('app.url') }}">{{ config('app.name') }}</a>
          </div>
        </footer>
    </body>
</html>
