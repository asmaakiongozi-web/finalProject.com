@extends(auth()->user()->usertype === 'professional' ? 'layouts.professional' : 'layouts.user')

@section('content')
<style>
    .resource-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8f0ec;
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }
    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    .resource-header {
        padding: 1.5rem 1.5rem 1rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .resource-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f2c24;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .resource-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.75rem;
    }
    .resource-category {
        background: #e8f5f0;
        color: #2d7a5c;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    .resource-type {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: #666;
    }
    .resource-content {
        padding: 1rem 1.5rem;
        color: #555;
        line-height: 1.65;
    }
    .resource-footer {
        padding: 1rem 1.5rem 1.5rem 1.5rem;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .resource-author {
        font-size: 0.85rem;
        color: #666;
        font-weight: 500;
    }
    .resource-actions {
        display: flex;
        gap: 0.5rem;
    }
    .btn-resource {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 6px;
    }
    .category-filter {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8f0ec;
    }
    .category-btn {
        background: #f8fafc;
        border: 1px solid #e0e0e0;
        color: #666;
        padding: 0.55rem 1rem;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .category-btn:hover,
    .category-btn.active {
        background: #2d7a5c;
        border-color: #2d7a5c;
        color: white;
        transform: translateY(-1px);
    }
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #666;
    }
    .empty-state i {
        font-size: 3rem;
        color: #ddd;
        margin-bottom: 1rem;
    }
    .page-link {
        color: #2d7a5c;
        border-color: #e8f0ec;
    }
    .page-link:hover {
        color: #2d7a5c;
        background-color: #e8f5f0;
        border-color: #2d7a5c;
    }
    .page-item.active .page-link {
        background-color: #2d7a5c;
        border-color: #2d7a5c;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1" style="color: #0f2c24; font-weight: 700;">Resource Library</h1>
        <p class="text-muted mb-0">Professional resources to support your mental health journey.</p>
    </div>
</div>

@if(auth()->user()->usertype !== 'professional')
<div class="category-filter">
    <h6 class="mb-3" style="color: #0f2c24; font-weight: 600;">Filter by Category</h6>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('resources.index') }}" class="category-btn {{ is_null($category) ? 'active' : '' }}">All Resources</a>
        <a href="{{ route('resources.category', 'general') }}" class="category-btn {{ ($category ?? '') === 'general' ? 'active' : '' }}">General</a>
        <a href="{{ route('resources.category', 'anxiety') }}" class="category-btn {{ ($category ?? '') === 'anxiety' ? 'active' : '' }}">Anxiety</a>
        <a href="{{ route('resources.category', 'depression') }}" class="category-btn {{ ($category ?? '') === 'depression' ? 'active' : '' }}">Depression</a>
        <a href="{{ route('resources.category', 'stress') }}" class="category-btn {{ ($category ?? '') === 'stress' ? 'active' : '' }}">Stress</a>
        <a href="{{ route('resources.category', 'relationships') }}" class="category-btn {{ ($category ?? '') === 'relationships' ? 'active' : '' }}">Relationships</a>
        <a href="{{ route('resources.category', 'self-care') }}" class="category-btn {{ ($category ?? '') === 'self-care' ? 'active' : '' }}">Self Care</a>
        <a href="{{ route('resources.category', 'coping-skills') }}" class="category-btn {{ ($category ?? '') === 'coping-skills' ? 'active' : '' }}">Coping Skills</a>
    </div>
</div>

<div class="category-filter mt-4">
    <h6 class="mb-3" style="color: #0f2c24; font-weight: 600;">Filter by Type</h6>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('resources.index') }}" class="category-btn {{ is_null($type ?? null) ? 'active' : '' }}">All Types</a>
        <a href="{{ route('resources.type', 'article') }}" class="category-btn {{ ($type ?? '') === 'article' ? 'active' : '' }}">Articles</a>
        <a href="{{ route('resources.type', 'audio') }}" class="category-btn {{ ($type ?? '') === 'audio' ? 'active' : '' }}">Audio Resources</a>
        <a href="{{ route('resources.type', 'video') }}" class="category-btn {{ ($type ?? '') === 'video' ? 'active' : '' }}">Video Resources</a>
    </div>
</div>
@endif

<div class="row">
    @forelse($resources as $resource)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="resource-card">
                <div class="resource-header">
                    <h5 class="resource-title">{{ $resource->title }}</h5>
                    <div class="resource-meta">
                        <span class="resource-category">{{ ucfirst($resource->category) }}</span>
                        <span class="resource-type">
                            <i class="fas fa-{{ $resource->type === 'article' ? 'file-alt' : ($resource->type === 'audio' ? 'headphones' : ($resource->type === 'video' ? 'play-circle' : ($resource->type === 'pdf' ? 'file-pdf' : 'link'))) }}"></i>
                            {{ ucfirst($resource->type) }}
                        </span>
                    </div>
                </div>
                @if($resource->description)
                    <div class="resource-content">
                        <p>{{ \Illuminate\Support\Str::limit($resource->description, 120) }}</p>
                    </div>
                @endif
                <div class="resource-footer">
                    <div class="resource-author">
                        <i class="fas fa-user-md me-1"></i>
                        {{ $resource->user->name ?? 'Professional' }}
                        @if($resource->posted_by_type === 'admin')
                            <span class="badge bg-primary ms-1">Admin</span>
                        @else
                            <span class="badge bg-success ms-1">Professional</span>
                        @endif
                    </div>
                    <div class="resource-actions">
                        <a href="{{ route('resources.show', $resource) }}" class="btn btn-primary btn-resource">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h4>No Resources Found</h4>
                <p>{{ ($category ?? null) ? 'No resources found in this category yet.' : 'No resources have been posted yet. Check back later!' }}</p>
            </div>
        </div>
    @endforelse
</div>

@if($resources->hasPages())
    <div class="d-flex justify-content-center">
        {{ $resources->links() }}
    </div>
@endif
@endsection
"@
