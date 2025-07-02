<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                    <a class="nav-link {{ request()->routeIs('price') ? 'active' : '' }}" href="{{ route('price') }}">Price</a>
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- End of navbar --}}

    {{-- Heroes --}}
    <main>
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72"
                height="57">
            <h1 class="display-5 fw-bold text-body-emphasis">Centered hero</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s
                    most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system,
                    extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
                </div>
            </div>
        </div>
    {{-- End of heroes --}}

    {{-- Features --}}
        <div class="container px-4 py-5" id="custom-cards">
            <h2 class="pb-2 border-bottom">Custom cards</h2>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                        style="background-image: url('unsplash-photo-1.jpg');">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Short title, long jacket</h3>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32"
                                        class="rounded-circle border border-white">
                                </li>
                                <li class="d-flex align-items-center me-3">
                                    <svg class="bi me-2" width="1em" height="1em" role="img" aria-label="Location">
                                        <use xlink:href="#geo-fill"></use>
                                    </svg>
                                    <small>Earth</small>
                                </li>
                                <li class="d-flex align-items-center">
                                    <svg class="bi me-2" width="1em" height="1em" role="img" aria-label="Duration">
                                        <use xlink:href="#calendar3"></use>
                                    </svg>
                                    <small>3d</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                        style="background-image: url('unsplash-photo-2.jpg');">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Much longer title that wraps to multiple lines
                            </h3>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <img src="https://github.com/twbs.png" alt="Bootstrap" width="32" height="32"
                                        class="rounded-circle border border-white">
                                </li>
                                <li class="d-flex align-items-center me-3">
                                    <svg class="bi me-2" width="1em" height="1em" role="img"
                                        aria-label="Location">
                                        <use xlink:href="#geo-fill"></use>
                                    </svg> <small>Pakistan</small>
                                </li>
                                <li class="d-flex align-items-center">
                                    <svg class="bi me-2" width="1em"
                                        height="1em" role="img" aria-label="Duration">
                                        <use xlink:href="#calendar3"></use>
                                    </svg>
                                    <small>4d</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                        style="background-image: url('unsplash-photo-3.jpg');">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Another longer title belongs here</h3>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto"> <img src="https://github.com/twbs.png" alt="Bootstrap"
                                        width="32" height="32" class="rounded-circle border border-white"> </li>
                                <li class="d-flex align-items-center me-3"> <svg class="bi me-2" width="1em"
                                        height="1em" role="img" aria-label="Location">
                                        <use xlink:href="#geo-fill"></use>
                                    </svg> <small>California</small> </li>
                                <li class="d-flex align-items-center">
                                    <svg class="bi me-2" width="1em" height="1em" role="img" aria-label="Duration">
                                        <use xlink:href="#calendar3"></use>
                                    </svg>
                                    <small>5d</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- End of features --}}

    {{-- Jumbotron --}}
        <div class="my-5">
            <div class="p-5 text-center bg-body-tertiary">
                <div class="container py-5">
                    <h1 class="text-body-emphasis">Full-width jumbotron</h1>
                    <p class="col-lg-8 mx-auto lead">This takes the basic jumbotron above and makes its background edge-to-edge with a<code>.container</code> inside to align content. Similar to above, it's been recreated with built-in grid and utility classes.
                    </p>
                </div>
            </div>
        </div>
    {{-- End of jumbotron --}}
    </main>

    {{-- Footer --}}
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Features</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Pricing</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">FAQs</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">About</a>
                </li>
            </ul>
            <p class="text-center text-body-secondary">© 2025 Company, Inc</p>
        </footer>
    </div>
    {{-- End of footer --}}
</body>
</html>
