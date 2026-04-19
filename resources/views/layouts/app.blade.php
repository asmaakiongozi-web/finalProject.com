<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .sidebar-fixed {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1020;
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 1030;
            width: calc(100% - 280px);
        }

        .main-content {
            margin-left: 280px;
            margin-top: 64px;
            padding: 1.5rem;
            min-height: calc(100vh - 64px);
        }

        /* SIDEBAR STYLES */
        .sidebar-green {
            width: 280px;
            background: #0f2c24;
            background: linear-gradient(180deg, #0f2c24 0%, #0a241d 100%);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
            border-right: 1px solid #2c5443;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-green::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-green::-webkit-scrollbar-track {
            background: #1e3f34;
        }
        .sidebar-green::-webkit-scrollbar-thumb {
            background: #5f9e82;
            border-radius: 10px;
        }

        .sidebar-inner {
            padding: 1.8rem 1rem 2rem 1rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 0.75rem 1.25rem 0.75rem;
            margin-bottom: 1.8rem;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }
        .sidebar-brand i {
            font-size: 1.9rem;
            color: #c0e0d2;
        }
        .sidebar-brand span {
            font-size: 1.35rem;
            font-weight: 600;
            letter-spacing: -0.2px;
            color: white;
        }
        .sidebar-brand small {
            font-size: 0.7rem;
            font-weight: 400;
            color: #bcd9cd;
            display: block;
            margin-top: 2px;
        }

        .nav-green {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            list-style: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
        }

        .nav-green .nav-item {
            list-style: none;
        }

        .nav-green .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.9rem;
            color: #e2efea;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            line-height: 1.4;
        }

        .nav-green .nav-link-custom i {
            width: 24px;
            font-size: 1.15rem;
            text-align: center;
            color: #c0dfd0;
        }

        .nav-green .nav-link-custom .dropdown-icon {
            margin-left: auto;
            font-size: 0.7rem;
            transition: transform 0.2s;
        }

        .nav-green .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }
        .nav-green .nav-link-custom:hover i {
            color: white;
        }

        .nav-green .nav-link-custom.active {
            background: #2d7a5c;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .nav-green .nav-link-custom.active i {
            color: white;
        }

        .dropdown-menu-custom {
            list-style: none;
            padding-left: 2.6rem;
            margin-top: 0.3rem;
            margin-bottom: 0.2rem;
            display: none;
            border-left: 2px solid #3f8268;
            margin-left: 1rem;
        }
        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom li {
            margin-bottom: 0.3rem;
        }

        .dropdown-menu-custom .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 0.9rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 450;
            color: #d2e6dd;
            text-decoration: none;
            transition: all 0.2s;
        }
        .dropdown-menu-custom .dropdown-link i {
            width: 20px;
            font-size: 0.8rem;
            color: #b1dbc9;
        }
        .dropdown-menu-custom .dropdown-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.1rem;
        }

        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 0.8rem 0.75rem;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            font-size: 0.7rem;
            text-align: center;
            color: #96bbaa;
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body class="font-sans antialiased">
    {{-- Sidebar kulingana na role --}}
    @if(auth()->user()->role == 'admin')
        @include('admin.partials.sidebar')
    @elseif(auth()->user()->role == 'user')
        @include('layouts.sidebars.user')
    @elseif(auth()->user()->role == 'professional')
        @include('professional.partials.sidebar')
    @endif

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Page content --}}
    <main class="main-content">
         @yield('content')
    </main>

    <!-- JavaScript for dropdown toggle -->
    <script>
        (function() {
            const dropdownTriggers = document.querySelectorAll('[data-dropdown]');
            
            function closeAllDropdowns(exceptId = null) {
                dropdownTriggers.forEach(trigger => {
                    const targetId = trigger.getAttribute('data-dropdown');
                    const dropdownMenu = document.getElementById(targetId);
                    if (dropdownMenu && targetId !== exceptId) {
                        dropdownMenu.classList.remove('show');
                        const chevron = trigger.querySelector('.dropdown-icon');
                        if (chevron) chevron.style.transform = 'rotate(0deg)';
                    }
                });
            }
            
            function toggleDropdown(dropdownId, triggerElement) {
                const dropdownMenu = document.getElementById(dropdownId);
                if (!dropdownMenu) return;
                const isExpanded = dropdownMenu.classList.contains('show');
                closeAllDropdowns(dropdownId);
                if (!isExpanded) {
                    dropdownMenu.classList.add('show');
                    const chevron = triggerElement.querySelector('.dropdown-icon');
                    if (chevron) chevron.style.transform = 'rotate(180deg)';
                } else {
                    dropdownMenu.classList.remove('show');
                    const chevron = triggerElement.querySelector('.dropdown-icon');
                    if (chevron) chevron.style.transform = 'rotate(0deg)';
                }
            }
            
            dropdownTriggers.forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdownId = this.getAttribute('data-dropdown');
                    if (dropdownId) {
                        toggleDropdown(dropdownId, this);
                    }
                });
            });
            
            const allNavLinks = document.querySelectorAll('.nav-link-custom, .dropdown-link');
            function removeActiveFromMain() {
                document.querySelectorAll('.nav-link-custom').forEach(link => link.classList.remove('active'));
            }
            
            allNavLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    if (!this.classList.contains('dropdown-link')) {
                        removeActiveFromMain();
                        this.classList.add('active');
                    } else {
                        const parentNavItem = this.closest('.nav-item');
                        if (parentNavItem) {
                            const parentMainLink = parentNavItem.querySelector('.nav-link-custom');
                            if (parentMainLink) {
                                removeActiveFromMain();
                                parentMainLink.classList.add('active');
                            }
                        }
                        document.querySelectorAll('.dropdown-link').forEach(dl => dl.classList.remove('active-sub'));
                        this.classList.add('active-sub');
                    }
                    const href = this.getAttribute('href');
                    if (href === "#") event.preventDefault();
                });
            });
            
            const dashLink = document.querySelector('.nav-link-custom[href*="dashboard"]') || document.querySelector('#dashboardLink');
            if (dashLink) {
                dashLink.classList.add('active');
            }
            
            document.addEventListener('click', function(e) {
                const sidebar = document.querySelector('.sidebar-green');
                if (sidebar && !sidebar.contains(e.target)) {
                    dropdownTriggers.forEach(trigger => {
                        const ddId = trigger.getAttribute('data-dropdown');
                        const menu = document.getElementById(ddId);
                        if (menu && menu.classList.contains('show')) {
                            menu.classList.remove('show');
                            const chev = trigger.querySelector('.dropdown-icon');
                            if (chev) chev.style.transform = 'rotate(0deg)';
                        }
                    });
                }
            });
            
            const style = document.createElement('style');
            style.innerHTML = `.active-sub { background: rgba(45, 122, 92, 0.25); color: #ffffff !important; border-radius: 10px; } .dropdown-link.active-sub i { color: white; }`;
            document.head.appendChild(style);
        })();
    </script>
</body>
</html>