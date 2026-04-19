<!-- PROFESSIONAL SIDEBAR — CONSTANT LAYOUT, DROPDOWN FEATURES, GREEN COLOR -->
<aside class="sidebar-green sidebar-fixed" id="professionalSidebar">
    <div class="sidebar-inner">
        <!-- Brand / Logo -->
        <div class="sidebar-brand">
            <i class="fas fa-brain"></i>
            <div>
                <span>MindCare</span>
                <small>Professional Suite</small>
            </div>
        </div>

        <!-- Navigation (main) -->
        <ul class="nav-green">
            <!-- Dashboard (single, no dropdown) -->
            <li class="nav-item">
                <a class="nav-link-custom" href="#" id="dashboardLink">
                    <i class="fas fa-chalkboard-user me-2"></i> Dashboard
                </a>
            </li>

            <!-- Users with dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="usersDropdown">
                    <i class="fas fa-users me-2"></i> Users
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="usersDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-user-check"></i> All Users</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-user-tag"></i> User Roles</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-shield-alt"></i> Permissions</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-user-plus"></i> Add New User</a></li>
                </ul>
            </li>

            <!-- Community Forum with dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="forumDropdown">
                    <i class="fas fa-comments me-2"></i> Community Forum
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="forumDropdown">
                    <li><a class="dropdown-link" href="{{url('community')}}"><i class="fas fa-message"></i> All Discussions</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-flag"></i> Reported Posts</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-trophy"></i> Top Contributors</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-layer-group"></i> Categories</a></li>
                </ul>
            </li>

            <!-- Mental Health Resources dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="resourcesDropdown">
                    <i class="fas fa-book-open me-2"></i> Mental Health Resources
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="resourcesDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-file-alt"></i> Articles & Guides</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-video"></i> Video Library</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-phone-alt"></i> Crisis Helplines</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-calendar-week"></i> Wellness Events</a></li>
                </ul>
            </li>

            <!-- Reports & Analytics dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="reportsDropdown">
                    <i class="fas fa-chart-line me-2"></i> Reports & Analytics
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="reportsDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-chart-simple"></i> Dashboard Metrics</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-users-viewfinder"></i> User Engagement</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-download"></i> Export Reports</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-chart-gantt"></i> Mental Health Trends</a></li>
                </ul>
            </li>

            <!-- Divider for professional separation -->
            <li class="nav-divider"></li>

            <!-- Settings dropdown -->
            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="settingsDropdown">
                    <i class="fas fa-sliders-h me-2"></i> Settings
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="settingsDropdown">
                    <li><a class="dropdown-link" href="#"><i class="fas fa-palette"></i> Appearance</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-lock"></i> Privacy & Security</a></li>
                </ul>
            </li>
        </ul>

        <!-- footer info: professional meta -->
        <div class="sidebar-footer">
            <i class="fas fa-shield-heart me-1"></i> HIPAA Ready · v3.2
        </div>
    </div>
</aside>