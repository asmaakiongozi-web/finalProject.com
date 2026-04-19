<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Professional Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
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
        }

        .main-content {
            margin-left: 280px;
            margin-top: 56px; /* Match navbar height */
            padding: 1.5rem;
        }

        /* SIDEBAR — fixed width, constant, no unexpected shifts */
        .sidebar-green {
            width: 280px;
            flex-shrink: 0;
            background: #0f2c24;
            background: linear-gradient(180deg, #0f2c24 0%, #0a241d 100%);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
            border-right: 1px solid #2c5443;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            overflow-x: hidden;
            transition: none;
            z-index: 1020;
        }

        /* Custom scrollbar (subtle) */
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

        /* Brand area — professional, clean */
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

        /* Navigation list — constant spacing */
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

        /* Main link style */
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

        /* DROPDOWN MENU — collapsible, professional indentation */
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

        /* divider */
        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 0.8rem 0.75rem;
        }

        /* footer stays at bottom */
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
<body>

{{-- Sidebar --}}
@include('professional.partials.sidebar')

{{-- Navbar --}}
@include('professional.partials.navbar')

<div class="main-content">
    @yield('content')
</div>

<!-- JAVASCRIPT: Dropdown toggles, active state, mobile support -->
<script>
    (function() {
        // Get all dropdown triggers
        const dropdownTriggers = document.querySelectorAll('[data-dropdown]');
        
        // close all dropdowns except optionally given id
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
        
        // Toggle specific dropdown
        function toggleDropdown(dropdownId, triggerElement) {
            const dropdownMenu = document.getElementById(dropdownId);
            if (!dropdownMenu) return;
            const isExpanded = dropdownMenu.classList.contains('show');
            // close all others first to keep clean
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
        
        // Attach click listeners to dropdown triggers
        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdownId = this.getAttribute('data-dropdown');
                if (dropdownId) {
                    toggleDropdown(dropdownId, this);
                }
            });
        });
        
        // Active state management for main links and dropdown links
        const allNavLinks = document.querySelectorAll('.nav-link-custom, .dropdown-link');
        function removeActiveFromMain() {
            document.querySelectorAll('.nav-link-custom').forEach(link => link.classList.remove('active'));
        }
        
        allNavLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                // handle main nav-link-custom
                if (!this.classList.contains('dropdown-link')) {
                    removeActiveFromMain();
                    this.classList.add('active');
                } else {
                    // for dropdown link: highlight parent main category
                    const parentNavItem = this.closest('.nav-item');
                    if (parentNavItem) {
                        const parentMainLink = parentNavItem.querySelector('.nav-link-custom');
                        if (parentMainLink) {
                            removeActiveFromMain();
                            parentMainLink.classList.add('active');
                        }
                    }
                    // optional: mark active on sub-item visually
                    document.querySelectorAll('.dropdown-link').forEach(dl => dl.classList.remove('active-sub'));
                    this.classList.add('active-sub');
                }
                // if href is "#" prevent default to avoid scrolling
                const href = this.getAttribute('href');
                if (href === "#") event.preventDefault();
                // for demo, any other real links like {{url('community')}} will behave normally
            });
        });
        
        // Dashboard link active by default
        const dashLink = document.querySelector('#dashboardLink');
        if (dashLink) {
            dashLink.classList.add('active');
            dashLink.addEventListener('click', function(e) {
                removeActiveFromMain();
                this.classList.add('active');
            });
        }
        
        // Close dropdowns when clicking outside sidebar (professional behavior)
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
        
        // Add style for active-sub
        const style = document.createElement('style');
        style.innerHTML = `.active-sub { background: rgba(45, 122, 92, 0.25); color: #ffffff !important; border-radius: 10px; } .dropdown-link.active-sub i { color: white; }`;
        document.head.appendChild(style);
    })();
</script>

</body>
</html>