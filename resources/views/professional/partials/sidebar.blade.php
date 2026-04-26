<!-- PROFESSIONAL SIDEBAR — CLEAN DASHBOARD MENU FOR PROFESSIONALS -->
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
            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('professional.dashboard') }}" id="dashboardLink">
                    <i class="fas fa-chalkboard-user me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('professional.messages') }}">
                    <i class="fas fa-comments me-2"></i> Messages
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link-custom" href="{{ route('community.index') }}">
                    <i class="fas fa-users me-2"></i> Community
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="resourcesDropdown">
                    <i class="fas fa-book-open me-2"></i> Resources
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="resourcesDropdown">
                    <li><a class="dropdown-link" href="{{ route('resources.create') }}"><i class="fas fa-plus-circle"></i> Add Resource</a></li>
                    <li><a class="dropdown-link" href="{{ route('resources.manage') }}"><i class="fas fa-cog"></i> Manage Resources</a></li>
                    <li><a class="dropdown-link" href="{{ route('resources.index') }}"><i class="fas fa-eye"></i> View Resources</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <div class="nav-link-custom" data-dropdown="settingsDropdown">
                    <i class="fas fa-cog me-2"></i> Settings
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <ul class="dropdown-menu-custom" id="settingsDropdown">
                    <li><a class="dropdown-link" href="{{ route('admin.settings.appearance') }}"><i class="fas fa-palette"></i> Appearance</a></li>
                    <li><a class="dropdown-link" href="#"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a class="dropdown-link" href="{{ route('admin.settings.account') }}"><i class="fas fa-shield-alt"></i> Privacy</a></li>
                </ul>
            </li>
        </ul>

        
    </div>
</aside>