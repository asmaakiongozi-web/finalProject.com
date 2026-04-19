<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
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
            padding: 0;
        }
        /* ========= GREEN THEME SIDEBAR (STANDALONE) ========= */
        .sidebar-green {
            background: #0a3b2f;
            background: linear-gradient(145deg, #0f4c3a 0%, #0a3b2f 100%);
            width: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
            box-shadow: -8px 0 20px rgba(0, 0, 0, 0.08);
            border-right: 1px solid #2a6e4f;
        }

        .sidebar-green .sidebar-inner {
            padding: 1.8rem 1rem 2rem 1rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* brand / logo area */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 0.75rem 1.5rem 0.75rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .sidebar-brand i {
            font-size: 2rem;
            color: #c8f0e1;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        .sidebar-brand span {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: white;
        }
        .sidebar-brand small {
            font-size: 0.7rem;
            font-weight: 400;
            color: #b9dfce;
            display: block;
            margin-top: 2px;
        }

        /* nav flex column */
        .nav-green {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            list-style: none;
            padding-left: 0;
        }

        .nav-green .nav-item {
            list-style: none;
        }

        .nav-green .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            border-radius: 14px;
            font-weight: 500;
            font-size: 0.95rem;
            color: #e2f0ea;
            text-decoration: none;
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .nav-green .nav-link-custom i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
            color: #bbdfcf;
            transition: color 0.2s;
        }

        .nav-green .nav-link-custom .dropdown-icon {
            margin-left: auto;
            font-size: 0.75rem;
            transition: transform 0.25s;
        }

        .nav-green .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }
        .nav-green .nav-link-custom:hover i {
            color: white;
        }

        .nav-green .nav-link-custom.active {
            background: #2c8c6b;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .nav-green .nav-link-custom.active i {
            color: white;
        }

        /* dropdown menu container (collapsible) */
        .dropdown-menu-custom {
            list-style: none;
            padding-left: 2.8rem;
            margin-top: 0.3rem;
            margin-bottom: 0.2rem;
            display: none;
            border-left: 2px dashed #4cae8c;
            margin-left: 1rem;
        }
        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom li {
            margin-bottom: 0.4rem;
        }

        .dropdown-menu-custom .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 0.9rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 450;
            color: #d2ecdf;
            text-decoration: none;
            transition: all 0.2s;
        }
        .dropdown-menu-custom .dropdown-link i {
            width: 20px;
            font-size: 0.8rem;
            color: #b3dbc9;
        }
        .dropdown-menu-custom .dropdown-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.2rem;
        }

        /* divider */
        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 1rem 0.75rem;
        }

        /* footer */
        .sidebar-footer {
            margin-top: auto;
            padding-top: 2rem;
            font-size: 0.7rem;
            text-align: center;
            color: #9fcbbc;
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
@include('admin.partials.sidebar')

{{-- Navbar --}}
@include('admin.partials.navbar')

<div class="main-content">
    @yield('content')
</div>

<!-- JavaScript for dropdown toggle + active state management -->
<script>
    (function() {
        // Get all dropdown triggers (elements with data-dropdown attribute)
        const dropdownTriggers = document.querySelectorAll('[data-dropdown]');
        
        // Helper: close all dropdowns except optionally the one being opened
        function closeAllDropdowns(exceptId = null) {
            dropdownTriggers.forEach(trigger => {
                const targetId = trigger.getAttribute('data-dropdown');
                const dropdownMenu = document.getElementById(targetId);
                if (dropdownMenu) {
                    if (exceptId !== targetId) {
                        dropdownMenu.classList.remove('show');
                        const chevron = trigger.querySelector('.dropdown-icon');
                        if (chevron) {
                            chevron.style.transform = 'rotate(0deg)';
                        }
                    }
                }
            });
        }
        
        // Function to toggle a specific dropdown
        function toggleDropdown(dropdownId, triggerElement) {
            const dropdownMenu = document.getElementById(dropdownId);
            if (!dropdownMenu) return;
            
            const isExpanded = dropdownMenu.classList.contains('show');
            // Close all other dropdowns first (clean UX)
            closeAllDropdowns(dropdownId);
            
            if (!isExpanded) {
                dropdownMenu.classList.add('show');
                const chevron = triggerElement.querySelector('.dropdown-icon');
                if (chevron) {
                    chevron.style.transform = 'rotate(180deg)';
                }
            } else {
                dropdownMenu.classList.remove('show');
                const chevron = triggerElement.querySelector('.dropdown-icon');
                if (chevron) {
                    chevron.style.transform = 'rotate(0deg)';
                }
            }
        }
        
        // attach click listeners to each trigger
        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdownId = this.getAttribute('data-dropdown');
                if (dropdownId) {
                    toggleDropdown(dropdownId, this);
                }
            });
        });
        
        // Handle active class for main links and dropdown links
        const allLinks = document.querySelectorAll('.nav-link-custom, .dropdown-link');
        allLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                // For main nav-link-custom (including those with dropdowns)
                if (!this.classList.contains('dropdown-link')) {
                    document.querySelectorAll('.nav-link-custom').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                } else {
                    // For submenu items: highlight parent main link
                    const parentNavItem = this.closest('.nav-item');
                    if (parentNavItem) {
                        const parentMainLink = parentNavItem.querySelector('.nav-link-custom');
                        if (parentMainLink) {
                            document.querySelectorAll('.nav-link-custom').forEach(l => l.classList.remove('active'));
                            parentMainLink.classList.add('active');
                        }
                    }
                    // Optional visual for active sub-item
                    document.querySelectorAll('.dropdown-link').forEach(dl => dl.classList.remove('active-sub'));
                    this.classList.add('active-sub');
                }
                // Prevent default for # links to avoid page jump
                const hrefAttr = this.getAttribute('href');
                if (hrefAttr === "#" || (hrefAttr && hrefAttr.startsWith('#')) || !hrefAttr) {
                    if (hrefAttr === "#") event.preventDefault();
                }
            });
        });
        
        // For dashboard route demo: if the dashboard link is clicked, set active
        const dashboardLink = document.querySelector('.nav-link-custom[href*="dashboard"]');
        if (dashboardLink) {
            dashboardLink.addEventListener('click', function() {
                document.querySelectorAll('.nav-link-custom').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        }
        
        // Close dropdowns when clicking outside sidebar (optional, enhances UX)
        document.body.addEventListener('click', function(e) {
            const sidebarArea = document.querySelector('.sidebar-green');
            if (sidebarArea && !sidebarArea.contains(e.target)) {
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
        
        // Add small style for active-sub highlight
        const style = document.createElement('style');
        style.innerHTML = `.active-sub { background: rgba(44, 140, 107, 0.3); color: #fff !important; } .dropdown-link.active-sub i { color: white; }`;
        document.head.appendChild(style);
        
        // initial chevron states
        dropdownTriggers.forEach(trigger => {
            const dropdownId = trigger.getAttribute('data-dropdown');
            const menu = document.getElementById(dropdownId);
            if (menu && !menu.classList.contains('show')) {
                const chevron = trigger.querySelector('.dropdown-icon');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            }
        });
    })();
</script>

</body>
</html>