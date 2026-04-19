<!-- USER SIDEBAR — MOOD TRACKING, DIARY, COMMUNITY, RESOURCES, SELF-HELP GREEN COLOR -->
<aside class="sidebar-green sidebar-fixed" id="userSidebar">
    <div class="sidebar-inner">
        <!-- Brand / Logo -->
        <div class="sidebar-brand">
            <i class="fas fa-brain"></i>
            <div>
                <span>MindCare</span>
                <small>Your Wellness Hub</small>
            </div>
        </div>

        <!-- Navigation (main) -->
        <ul class="nav-green">
            <!-- Dashboard (single, no dropdown) -->
            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('dashboard') }}" id="dashboardLink">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>

            <!-- Mood Tracker with dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="moodTrackerDropdown">
                    <i class="fas fa-face-smile me-2"></i> Mood Tracker
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="moodTrackerDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-plus-circle"></i> Log Mood</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-chart-line"></i> Mood History Graph</a></li>
                </ul>
            </li>

            <!-- Diary with dropdown -->
            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('diary.index') }}">
                    <i class="fas fa-book me-2"></i> Diary
                </a>
            </li>

            <!-- Community Forum (single link) -->
            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('community.index') }}">
                    <i class="fas fa-comments me-2"></i> Community Forum
                </a>
            </li>

            <!-- Resource Library with dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="resourcesDropdown">
                    <i class="fas fa-book-open me-2"></i> Resource Library
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="resourcesDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-newspaper"></i> Articles</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-video"></i> Videos</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-headphones"></i> Audio Meditation</a></li>
                </ul>
            </li>

            <!-- Self Help Tools with dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="selfHelpDropdown">
                    <i class="fas fa-heart me-2"></i> Self-Help Tools
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="selfHelpDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-wind"></i> Breathing Exercises</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-hourglass-start"></i> Meditation Timer</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-music"></i> Relaxation Music</a></li>
                </ul>
            </li>

            <!-- Divider for separation -->
            <li class="nav-divider"></li>

            <!-- Settings -->
            <li class="nav-item">
                <a class="nav-link-custom" href="#">
                    <i class="fas fa-cog me-2"></i> Settings
                </a>
            </li>
        </ul>

        <!-- footer info: user meta -->
        <div class="sidebar-footer">
            <i class="fas fa-heart me-1"></i> Your Mental Health Matters · v1.0
        </div>
    </div>
</aside>