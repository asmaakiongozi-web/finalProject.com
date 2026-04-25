@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1" style="color: #0f2c24; font-weight: 700;">Admin Dashboard</h1>
                    <p class="text-muted mb-0">Manage the platform </p>
                </div>
                <div class="text-end">
                    <div class="text-muted small">Administrator</div>
                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-success mb-2">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\Resource::count() }}</h4>
                    <p class="text-muted mb-0">Total Resources</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-primary mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\User::count() }}</h4>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-info mb-2">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\Discussion::count() }}</h4>
                    <p class="text-muted mb-0">Forum Discussions</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-warning mb-2">
                        <i class="fas fa-user-md fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\User::where('usertype', 'professional')->count() }}</h4>
                    <p class="text-muted mb-0">Professionals</p>
                </div>
            </div>
        </div>
    </div>

    
    
</div>
@endsection