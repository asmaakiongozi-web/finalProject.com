@extends(auth()->user()->usertype === 'professional' ? 'layouts.professional' : 'layouts.user')

@section('content')
<style>
    .resource-detail-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        border: 1px solid #e8f0ec;
        overflow: hidden;
    }
    .resource-detail-header {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .resource-detail-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f2c24;
        margin-bottom: 0.75rem;
    }
    .resource-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        color: #6b7280;
        font-size: 0.95rem;
    }
    .resource-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .resource-detail-body {
        padding: 1.75rem 2rem;
        color: #4b5563;
        line-height: 1.8;
    }
    .resource-actions {
        padding: 1.25rem 2rem 2rem 2rem;
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .resource-sidebar {
        background: white;
        border-radius: 14px;
        border: 1px solid #e8f0ec;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        padding: 1.5rem;
    }
    .resource-sidebar h5 {
        margin-bottom: 1rem;
        font-weight: 600;
        color: #0f2c24;
    }
    .resource-sidebar .sidebar-item {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
        margin-bottom: 0.85rem;
        color: #4b5563;
    }
    .resource-sidebar .sidebar-item span:last-child {
        font-weight: 600;
        color: #111827;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1" style="color: #0f2c24; font-weight: 700;">{{ $resource->title }}</h1>
        <p class="text-muted mb-0">Detailed view for this professional resource.</p>
    </div>
    <a href="{{ route('resources.index') }}" class="btn btn-outline-secondary">Back to Resources</a>
</div>

<div class="row gy-4">
    <div class="col-lg-8">
        <div class="resource-detail-card">
            <div class="resource-detail-header">
                <div class="resource-detail-meta">
                    <span><i class="fas fa-book-open"></i> {{ ucfirst($resource->type) }}</span>
                    <span><i class="fas fa-tags"></i> {{ ucfirst($resource->category) }}</span>
                    <span><i class="fas fa-calendar"></i> {{ $resource->created_at->format('M j, Y') }}</span>
                </div>
            </div>
            <div class="resource-detail-body">
                @if($resource->description)
                    <p class="mb-4">{{ $resource->description }}</p>
                @endif
                @if($resource->type === 'video' && $resource->content)
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe src="{{ $resource->content }}" title="{{ $resource->title }} video" allowfullscreen></iframe>
                    </div>
                @elseif($resource->type === 'audio' && $resource->content)
                    <div class="mb-4">
                        <audio controls class="w-100">
                            <source src="{{ $resource->content }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @elseif($resource->type === 'pdf' && $resource->file_path)
                    <div class="mb-4">
                        <a href="{{ asset('storage/' . $resource->file_path) }}" download class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf me-2"></i>Download PDF
                        </a>
                    </div>
                @elseif($resource->type === 'link' && $resource->content)
                    <div class="mb-4">
                        <a href="{{ $resource->content }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-link me-2"></i>Visit Link
                        </a>
                    </div>
                @endif
                @if($resource->type === 'article' && $resource->content)
                    <div class="mt-4">
                        {!! nl2br(e($resource->content)) !!}
                    </div>
                @endif
            </div>
            <div class="resource-actions">
                <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back to Library</a>
                @if($resource->file_path && $resource->type !== 'pdf')
                    <a href="{{ asset('storage/' . $resource->file_path) }}" download class="btn btn-outline-primary">Download File</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="resource-sidebar">
            <h5>Resource Details</h5>
            <div class="sidebar-item"><span>Author</span><span>{{ $resource->user->name ?? 'Professional' }}</span></div>
            <div class="sidebar-item"><span>Posted As</span><span>{{ $resource->posted_by_type === 'admin' ? 'Admin' : 'Professional' }}</span></div>
            <div class="sidebar-item"><span>Category</span><span>{{ ucfirst($resource->category) }}</span></div>
            <div class="sidebar-item"><span>Type</span><span>{{ ucfirst($resource->type) }}</span></div>
            <div class="sidebar-item"><span>Updated</span><span>{{ $resource->updated_at->diffForHumans() }}</span></div>
        </div>
    </div>
</div>
@endsection
