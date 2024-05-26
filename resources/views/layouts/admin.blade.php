<!DOCTYPE html>
<html lang="en" class="">

<head>
    @vite('resources/css/app.css')

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Tailwind is included -->
    <link rel="stylesheet" href="{{ asset('./assets/css/main.css?v=1628755089081') }}">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name="description" content="Admin One - free Tailwind dashboard">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-130795909-1');
    </script>



</head>

<body>

    <div id="app">

        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item mobile-aside-button">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
                <div class="navbar-item">
                    <div class="control"><input placeholder="Search everywhere..." class="input"></div>
                </div>
            </div>

        </nav>

        <aside class="aside is-placed-left is-expanded overflow-x-scroll">
            <div class="aside-tools">
                <div><a href="/">
                    Vala <b class="font-black">Administration</b>
                    </a>

                </div>
            </div>
            <div class="menu is-menu-main">
                <p class="menu-label">General</p>
                <ul class="menu-list">
                    <li class="">
                        <a href="{{ route('admin.index') }}">
                            <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <p class="menu-label">Employés</p>
                <ul class="menu-list">
                    <li class="">
                        <a href="{{ route('admin.employee.index') }}">
                            <span class="icon"><i class="mdi mdi-table-large"></i></span>
                            <span class="menu-item-label">Liste des Employés</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.employee.create') }}">
                            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                            <span class="menu-item-label">Ajouter un Employé</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.leave.index') }}">
                            <span class="icon"><i class="mdi mdi-face-agent"></i></span>
                            <span class="menu-item-label">Congés</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('admin.leave.demande') }}">
                            <span class="icon"><i class="mdi mdi-face-agent"></i></span>
                            <span class="menu-item-label">Demande de Congés</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ route('admin.departement.index') }}">
                            <span class="icon"><i class="mdi mdi-briefcase"></i></span>
                            <span class="menu-item-label">Département</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.post.index') }}">
                            <span class="icon"><i class="mdi mdi-briefcase"></i></span>
                            <span class="menu-item-label">Postes</span>
                        </a>
                    </li>
                
                    <p class="menu-label">Stagiaires</p>
                    <ul class="menu-list">
                        <li class="">
                            <a href="{{ route('admin.stagiaire.index') }}">
                                <span class="icon"><i class="mdi mdi-table"></i></span>
                                <span class="menu-item-label">Liste des Stagiaires</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.stagiaire.create') }}">
                                <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                <span class="menu-item-label">Ajouter un Stagiaire</span>
                            </a>
                        </li>

                        <p class="menu-label">Projets</p>
                        <ul class="menu-list">
                            <li class="">
                                <a href="{{ route('admin.project.index') }}">
                                    <span class="icon"><i class="mdi mdi-table"></i></span>
                                    <span class="menu-item-label">Projet</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-list">
                            <li class="">
                                <form id="log_out" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                </form>

                                <a href="#" onclick="document.getElementById('log_out').submit()">
                                    <span class="icon"><i class="mdi mdi-logout"></i></span>
                                    <span class="menu-item-label">logout</span>
                                </a>
                            </li>
                        </ul>
                        {{--                <li class="--set-active-profile-html"> --}}
                        {{--                    <a href="profile.html"> --}}
                        {{--                        <span class="icon"><i class="mdi mdi-account-circle"></i></span> --}}
                        {{--                        <span class="menu-item-label">Profile</span> --}}
                        {{--                    </a> --}}
                        {{--                </li> --}}
                    </ul>
                </ul>
            </div>

        </aside>



        @yield('content')




    </div>

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src={{ asset('assets/js/main.min.js?v=1628755089081') }}></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>


    <script>
        // Open the modal when the trigger button is clicked
        const modalTrigger = document.querySelector('[data-modal-target="#modal"]');
        const modal = document.querySelector('#modal');
        const close = document.getElementById("close")
        if (modalTrigger) {

            modalTrigger.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });
        }

        // Close the modal when the user clicks outside of it
        if (close) {

            close.addEventListener('click', event => {
                modal.classList.add('hidden');
            });
        }
        let closeBtn = document.getElementById("close-alert");
        let success_alert = document.getElementById("success-alert")
        let fail_alert = document.getElementById("fail-alert")
        if (closeBtn) {
            if (success_alert) {

                closeBtn.addEventListener("click", function() {
                    success_alert.style.display = "none";
                });
            } else {

                closeBtn.addEventListener("click", function() {
                    fail_alert.style.display = "none";
                });
            }
        }
    </script>
    @yield('script')

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->

</body>

</html>
