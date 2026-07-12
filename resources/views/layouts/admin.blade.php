<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - ISCME 2027</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #003D6C; /* GAFTIM Primary */
            color: #fff;
        }
        .sidebar a {
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">ISCME Admin</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
                        <li class="nav-item w-100">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="{{ route('admin.pages.index') }}" class="nav-link text-white {{ request()->routeIs('admin.pages.*') ? 'active bg-primary' : '' }}">
                                <i class="bi bi-layout-text-window-reverse me-2"></i> Pages
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Speakers</span> </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-building"></i> <span class="ms-1 d-none d-sm-inline">Sponsors</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name=Admin" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3 bg-light">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
