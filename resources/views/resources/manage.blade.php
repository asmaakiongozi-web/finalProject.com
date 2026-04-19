@extends(auth()->user()->usertype === 'professional' ? 'layouts.professional' : 'layouts.user')

@section('content')
<style>
    .resource-management-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e8f0ec;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }
    .resource-management-card .resource-header {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .resource-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f2c24;
        margin-bottom: 0.4rem;
    }
    .resource-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        color: #6b7280;
        font-size: 0.9rem;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn-action {
        min-width: 95px;
    }
    .resource-content {
        padding: 1rem 1.5rem;
        color: #4b5563;
        line-height: 1.7;
    }
    .resource-actions {
        display: flex;
        justify-content: space-between;
        padding: 1rem 1.5rem 1.5rem 1.5rem;
        color: #6b7280;
        font-size: 0.9rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .resource-actions small {
        display: block;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 14px;
        border: 1px solid #e8f0ec;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    }
    .empty-state i {
        font-size: 3rem;
        color: #ddd;
        margin-bottom: 1rem;
    }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="card-title mb-1" style="color: #0f2c24;">Manage Your Resources</h5>
                        <p class="text-muted mb-0">Review, update, or remove the resources you have posted.</p>
                    </div>
                    <a href="{{ route('resources.create') }}" class="btn btn-success">Add Resource</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse($resources as $resource)
        <div class="col-12">
            <div class="resource-management-card">
                <div class="resource-header">
                    <div>
                        <h5 class="resource-title">{{ $resource->title }}</h5>
                        <div class="resource-meta">
                            <span>{{ ucfirst($resource->category) }}</span>
                            <span>{{ ucfirst($resource->type) }}</span>
                            <span>{{ $resource->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('resources.show', $resource) }}" class="btn btn-outline-primary btn-action">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                        <form method="POST" action="{{ route('resources.destroy', $resource) }}" onsubmit="return confirm('Delete this resource?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
                @if($resource->description)
                    <div class="resource-content">
                        <p>{{ \Illuminate\Support\Str::limit($resource->description, 200) }}</p>
                    </div>
                @endif
                <div class="resource-actions">
                    <small>{{ $resource->posted_by_type === 'admin' ? 'Posted as Administrator' : 'Posted as Professional' }}</small>
                    <small>Last updated {{ $resource->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h4>No Resources Yet</h4>
                <p>You haven't posted any resources yet. Start sharing helpful content with the community!</p>
                <a href="{{ route('resources.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-1"></i>Add Your First Resource
                </a>
            </div>
        </div>
    @endforelse
</div>

@if($resources->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $resources->links() }}
    </div>
@endif
@endsection
