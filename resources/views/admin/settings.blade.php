@extends('layouts.admin')

@section('content')
@php
    $theme = session('admin_appearance_theme', 'green');
    $sidebarStyle = session('admin_sidebar_style', 'gradient');
    $sidebarColor = session('admin_sidebar_color', '#0f4c3a');
    $navbarColor = session('admin_navbar_color', '#198754');
    $accentColor = session('admin_accent_color', '#2c8c6b');
    $activeSection = $activeSection ?? 'appearance';
    $sectionTitle = $activeSection === 'account' ? 'Privacy & Account Settings' : 'Appearance Settings';
    $sectionDescription = $activeSection === 'account'
        ? 'Update your admin username and password.'
        : 'Customize the admin dashboard look and feel.';
    $previewBg = $theme === 'dark' ? '#181a1f' : ($theme === 'light' ? '#f8f9fa' : '#eaf6ef');
    $previewText = $theme === 'dark' ? '#f9fafb' : '#1f2937';
    $sidebarPreview = $sidebarStyle === 'solid'
        ? $sidebarColor
        : ($sidebarStyle === 'soft'
            ? 'rgba(15,76,58,0.86)'
            : 'linear-gradient(145deg, '.$sidebarColor.' 0%, rgba(15,76,58,0.85) 100%)');
    $previewStyle = "background:{$previewBg}; color:{$previewText};";
    $badgeStyle = "background:{$accentColor}; color:white;";
    $sidebarPreviewStyle = "background:{$sidebarPreview}; padding:1rem;";
    $navbarPreviewStyle = "background:{$navbarColor}; padding:1rem;";
@endphp

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1" style="color: #0f2c24; font-weight: 700;">{{ $sectionTitle }}</h1>
                    <p class="text-muted mb-0">{{ $sectionDescription }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $theme = session('admin_appearance_theme', 'green');
        $sidebarStyle = session('admin_sidebar_style', 'gradient');
        $sidebarColor = session('admin_sidebar_color', '#0f4c3a');
        $navbarColor = session('admin_navbar_color', '#198754');
        $accentColor = session('admin_accent_color', '#2c8c6b');
        $activeSection = $activeSection ?? 'appearance';
        $sectionTitle = isset($sectionTitle)
            ? $sectionTitle
            : ($activeSection === 'account'
                ? 'Privacy & Account Settings'
                : 'Appearance Settings');
        $sectionDescription = isset($sectionDescription)
            ? $sectionDescription
            : ($activeSection === 'account'
                ? 'Update your admin username and password.'
                : 'Customize the admin dashboard look and feel.');
        $previewBg = $theme === 'dark' ? '#181a1f' : ($theme === 'light' ? '#f8f9fa' : '#eaf6ef');
        $previewText = $theme === 'dark' ? '#f9fafb' : '#1f2937';
        $sidebarPreview = $sidebarStyle === 'solid'
            ? $sidebarColor
            : ($sidebarStyle === 'soft'
                ? 'rgba(15,76,58,0.86)'
                : 'linear-gradient(145deg, '.$sidebarColor.' 0%, rgba(15,76,58,0.85) 100%)');
        $previewStyle = "background:{$previewBg}; color:{$previewText};";
        $badgeStyle = "background:{$accentColor}; color:white;";
        $sidebarPreviewStyle = "background:{$sidebarPreview}; padding:1rem;";
        $navbarPreviewStyle = "background:{$navbarColor}; padding:1rem;";
    @endphp

    <div class="row gy-4">
        <div class="col-lg-7 {{ $activeSection !== 'appearance' ? 'd-none' : '' }}" id="appearance">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3">Dashboard Appearance</h3>
                    <p class="text-muted">Choose your admin theme, sidebar color, and navbar color.</p>

                    <form method="POST" action="{{ route('admin.settings.appearance.save') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="theme" class="form-label fw-semibold">Theme</label>
                            <select id="theme" name="theme" class="form-select">
                                <option value="green" {{ $theme === 'green' ? 'selected' : '' }}>Green Wellness</option>
                                <option value="dark" {{ $theme === 'dark' ? 'selected' : '' }}>Dark Mode</option>
                                <option value="light" {{ $theme === 'light' ? 'selected' : '' }}>Light Mode</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="sidebar_style" class="form-label fw-semibold">Sidebar Style</label>
                            <select id="sidebar_style" name="sidebar_style" class="form-select">
                                <option value="gradient" {{ $sidebarStyle === 'gradient' ? 'selected' : '' }}>Gradient</option>
                                <option value="solid" {{ $sidebarStyle === 'solid' ? 'selected' : '' }}>Solid</option>
                                <option value="soft" {{ $sidebarStyle === 'soft' ? 'selected' : '' }}>Soft</option>
                            </select>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="sidebar_color" class="form-label fw-semibold">Sidebar Color</label>
                                <input id="sidebar_color" name="sidebar_color" type="color" value="{{ $sidebarColor }}" class="form-control form-control-color" style="width: 100%; height: 3rem; padding: 0.5rem;" />
                            </div>
                            <div class="col-md-4">
                                <label for="navbar_color" class="form-label fw-semibold">Navbar Color</label>
                                <input id="navbar_color" name="navbar_color" type="color" value="{{ $navbarColor }}" class="form-control form-control-color" style="width: 100%; height: 3rem; padding: 0.5rem;" />
                            </div>
                            <div class="col-md-4">
                                <label for="accent_color" class="form-label fw-semibold">Accent Color</label>
                                <input id="accent_color" name="accent_color" type="color" value="{{ $accentColor }}" class="form-control form-control-color" style="width: 100%; height: 3rem; padding: 0.5rem;" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="accent_color_text" class="form-label fw-semibold">Accent hex code</label>
                            <input id="accent_color_text" name="accent_color_text" type="text" value="{{ $accentColor }}" readonly class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-success px-4">Save Appearance</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7 {{ $activeSection !== 'account' ? 'd-none' : '' }}" id="account">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3">Account Settings</h3>
                    <p class="text-muted">Update your admin username and password.</p>

                    <form method="POST" action="{{ route('admin.settings.account.save') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Username</label>
                            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" class="form-control" required />
                        </div>

                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" required autocomplete="current-password" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">New Password</label>
                            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Save Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('accent_color');
        const colorText = document.getElementById('accent_color_text');

        if (colorInput && colorText) {
            colorInput.addEventListener('input', function() {
                colorText.value = colorInput.value;
            });
        }

        document.querySelectorAll('[data-style]').forEach(el => {
            const styleValue = el.dataset.style;
            if (styleValue) {
                el.style.cssText = styleValue;
            }
        });
    });
</script>
@endsection
