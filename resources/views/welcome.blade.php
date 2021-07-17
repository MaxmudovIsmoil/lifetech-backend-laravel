<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LIFE TECH</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" crossorigin="anonymous">
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .navbar-brand{
            font-weight: 600;
        }
        .jumbotron{
            background: white;
        }
    </style>
</head>
<body>
<div class="container-fluid bg-info">
    <nav class="navbar navbar-light bg-info" id="navbar-example1" style="padding: .5rem 1rem;"><a class="navbar-brand" href="#">LIFE TECH</a>
        <ul class="nav nav-pills" role="tablist">
            @if (Route::has('login'))
                @auth
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin') }}">Home</a></li>
                @else
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary" href="{{ url('login') }}">Login</a></li>
                @endauth
            @endif
        </ul>
    </nav>
</div>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"> Jumbotron
                            <div class="card-header-actions"><a class="card-header-action" href="https://coreui.io/docs/components/bootstrap-jumbotron/" target="_blank"><small class="text-muted">docs</small></a></div>
                        </div>
                        <div class="card-body">
                            <div class="jumbotron">
                                <h1 class="display-3">Life tech</h1>
                                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                                <hr class="my-4">
                                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                                <p class="lead"><a class="btn btn-primary btn-lg" href="http://life-tech.uz" role="button">life-tech.uz</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
