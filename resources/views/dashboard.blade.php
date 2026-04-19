<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>

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
            background-color: #f8fafc;
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

        /* Dashboard content styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        .card-header {
            border: none;
            background-color: white;
            border-radius: 12px 12px 0 0;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 122, 92, 0.3);
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
        }
        .stat-number {
            color: #2d7a5c;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="font-sans antialiased">
    {{-- Include Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Include Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Page content --}}
    <main class="main-content">
        <div class="container-fluid">
            <!-- Mood Summary Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-3">
                            <h5 class="mb-0" style="color: #0f2c24; font-weight: 600;">
                                <i class="fas fa-face-smile me-2" style="color: #2d7a5c;"></i>Mood Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-3" style="color: #0f2c24; font-weight: 600;">Today's Mood</h6>
                                    <div class="d-flex gap-3 mb-4">
                                        <button class="mood-btn" data-mood="very-sad" data-mood-label="Very Sad" title="Very Sad">😢</button>
                                        <button class="mood-btn" data-mood="sad" data-mood-label="Sad" title="Sad">😕</button>
                                        <button class="mood-btn" data-mood="neutral" data-mood-label="Neutral" title="Neutral">😐</button>
                                        <button class="mood-btn active" data-mood="happy" data-mood-label="Happy" title="Happy">😊</button>
                                        <button class="mood-btn" data-mood="very-happy" data-mood-label="Very Happy" title="Very Happy">😄</button>
                                    </div>
                                    <p class="small text-muted">Current mood: <strong id="currentMoodDisplay" style="color: #2d7a5c;">Happy</strong> <span id="moodTimestamp">(Updated just now)</span></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-3" style="color: #0f2c24; font-weight: 600;">Weekly Trend</h6>
                                    <div style="height: 150px; background: linear-gradient(to right, rgba(45, 122, 92, 0.1), rgba(45, 122, 92, 0.3)); border-radius: 8px; display: flex; align-items: flex-end; justify-content: space-around; padding: 1rem; gap: 0.5rem;">
                                        <div style="width: 100%; height: 40%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 60%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 45%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 75%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 50%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 70%; background: #2d7a5c; border-radius: 4px;"></div>
                                        <div style="width: 100%; height: 65%; background: #2d7a5c; border-radius: 4px;"></div>
                                    </div>
                                    <small class="text-muted d-block mt-2">Mon - Sun trend</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-3">
                            <h5 class="mb-0" style="color: #0f2c24; font-weight: 600;">
                                <i class="fas fa-bell me-2" style="color: #2d7a5c;"></i>Notifications
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="notification-item mb-3 pb-3 border-bottom">
                                <div class="d-flex">
                                    <div style="width: 8px; height: 8px; background: #2d7a5c; border-radius: 50%; margin-top: 0.4rem; margin-right: 1rem; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <h6 class="mb-1" style="color: #0f2c24; font-weight: 500;">New Message from Dr. Williams</h6>
                                        <p class="mb-1 small text-muted">You have a new response to your question about anxiety management.</p>
                                        <small class="text-muted">15 minutes ago</small>
                                    </div>
                                </div>
                            </div>

                            <div class="notification-item mb-3 pb-3 border-bottom">
                                <div class="d-flex">
                                    <div style="width: 8px; height: 8px; background: #2d7a5c; border-radius: 50%; margin-top: 0.4rem; margin-right: 1rem; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <h6 class="mb-1" style="color: #0f2c24; font-weight: 500;">Meditation Session Reminder</h6>
                                        <p class="mb-1 small text-muted">Time for your scheduled evening meditation session.</p>
                                        <small class="text-muted">1 hour ago</small>
                                    </div>
                                </div>
                            </div>

                            <div class="notification-item mb-3 pb-3 border-bottom">
                                <div class="d-flex">
                                    <div style="width: 8px; height: 8px; background: #bbb; border-radius: 50%; margin-top: 0.4rem; margin-right: 1rem; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <h6 class="mb-1" style="color: #0f2c24; font-weight: 500;">Weekly Wellness Report</h6>
                                        <p class="mb-1 small text-muted">Your weekly wellness report is ready for review.</p>
                                        <small class="text-muted">3 hours ago</small>
                                    </div>
                                </div>
                            </div>

                            <div class="notification-item">
                                <div class="d-flex">
                                    <div style="width: 8px; height: 8px; background: #bbb; border-radius: 50%; margin-top: 0.4rem; margin-right: 1rem; flex-shrink: 0;"></div>
                                    <div style="flex: 1;">
                                        <h6 class="mb-1" style="color: #0f2c24; font-weight: 500;">Community Poll: Favorite Relaxation Technique</h6>
                                        <p class="mb-1 small text-muted">Join the community discussion on preferred relaxation methods.</p>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Resources Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: #0f2c24; font-weight: 600;">
                                <i class="fas fa-book-open me-2" style="color: #2d7a5c;"></i>Recent Resources
                            </h5>
                            <a href="{{ route('resources.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body">
                            @php
                                $recentResources = \App\Models\Resource::with('user')->latest()->take(3)->get();
                            @endphp
                            @forelse($recentResources as $resource)
                            <div class="d-flex align-items-center p-3 border-bottom">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-light rounded p-2">
                                        <i class="fas fa-{{ $resource->type === 'article' ? 'file-alt' : ($resource->type === 'audio' ? 'headphones' : ($resource->type === 'video' ? 'play-circle' : ($resource->type === 'pdf' ? 'file-pdf' : 'link'))) }} text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $resource->title }}</h6>
                                    <small class="text-muted">{{ ucfirst($resource->category) }} • {{ ucfirst($resource->type) }} • {{ $resource->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">No resources available yet</h6>
                                <p class="text-muted small">Check back later for new content</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .mood-btn {
            font-size: 2rem;
            background: none;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .mood-btn:hover {
            border-color: #2d7a5c;
            background: rgba(45, 122, 92, 0.1);
            transform: scale(1.1);
        }
        .mood-btn.active {
            border-color: #2d7a5c;
            background: rgba(45, 122, 92, 0.2);
        }
    </style>

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

            // Mood button functionality
            const moodBtns = document.querySelectorAll('.mood-btn');
            const currentMoodDisplay = document.getElementById('currentMoodDisplay');
            const moodTimestamp = document.getElementById('moodTimestamp');

            moodBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    moodBtns.forEach(b => b.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Update the mood display
                    const moodLabel = this.getAttribute('data-mood-label');
                    const moodValue = this.getAttribute('data-mood');
                    currentMoodDisplay.textContent = moodLabel;
                    moodTimestamp.textContent = '(Updated just now)';
                    
                    // Optional: Save to local storage
                    localStorage.setItem('todaysMood', JSON.stringify({
                        mood: moodValue,
                        label: moodLabel,
                        timestamp: new Date().toISOString()
                    }));
                });
            });

            // Load mood from local storage if available
            const savedMood = localStorage.getItem('todaysMood');
            if (savedMood) {
                const moodData = JSON.parse(savedMood);
                const savedMoodBtn = document.querySelector(`[data-mood="${moodData.mood}"]`);
                if (savedMoodBtn) {
                    savedMoodBtn.classList.add('active');
                    currentMoodDisplay.textContent = moodData.label;
                    
                    // Calculate time difference
                    const savedTime = new Date(moodData.timestamp);
                    const now = new Date();
                    const diffMs = now - savedTime;
                    const diffMins = Math.floor(diffMs / 60000);
                    
                    if (diffMins === 0) {
                        moodTimestamp.textContent = '(Updated just now)';
                    } else if (diffMins < 60) {
                        moodTimestamp.textContent = `(Updated ${diffMins} minute${diffMins > 1 ? 's' : ''} ago)`;
                    } else {
                        const diffHours = Math.floor(diffMins / 60);
                        moodTimestamp.textContent = `(Updated ${diffHours} hour${diffHours > 1 ? 's' : ''} ago)`;
                    }
                }
            }
            
            const style = document.createElement('style');
            style.innerHTML = `.active-sub { background: rgba(45, 122, 92, 0.25); color: #ffffff !important; border-radius: 10px; } .dropdown-link.active-sub i { color: white; }`;
            document.head.appendChild(style);
        })();
    </script>
</body>
</html>