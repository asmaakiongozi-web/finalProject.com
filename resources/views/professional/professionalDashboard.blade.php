@extends('layouts.professional')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1" style="color: #0f2c24; font-weight: 700;">Professional Dashboard</h1>
                    <p class="text-muted mb-0">Manage your resources and support the community</p>
                </div>
                <div class="text-end">
                    <div class="text-muted small">Welcome back,</div>
                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3" style="color: #0f2c24;">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('resources.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add Resource</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('resources.manage') }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                                <i class="fas fa-cog"></i>
                                <span>Manage Resources</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('resources.index') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                                <i class="fas fa-eye"></i>
                                <span>View Resources</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('community.index') }}" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                                <i class="fas fa-comments"></i>
                                <span>Community Forum</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-success mb-2">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\Resource::where('posted_by', auth()->id())->count() }}</h4>
                    <p class="text-muted mb-0">Resources Posted</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="text-primary mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="mb-1">{{ \App\Models\User::where('usertype', 'user')->count() }}</h4>
                    <p class="text-muted mb-0">Community Members</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
    </div>

    <!-- Recent Resources -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" style="color: #0f2c24;">Your Recent Resources</h5>
                        <a href="{{ route('resources.manage') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $recentResources = \App\Models\Resource::where('posted_by', auth()->id())
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp

                    @forelse($recentResources as $resource)
                    <div class="d-flex align-items-center p-3 border-bottom">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-light rounded p-2">
                                <i class="fas fa-{{ $resource->type === 'article' ? 'file-alt' : ($resource->type === 'video' ? 'play-circle' : ($resource->type === 'pdf' ? 'file-pdf' : 'link')) }} text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $resource->title }}</h6>
                            <small class="text-muted">{{ ucfirst($resource->category) }} • {{ $resource->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No resources posted yet</h6>
                        <a href="{{ route('resources.create') }}" class="btn btn-primary">Add Your First Resource</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection