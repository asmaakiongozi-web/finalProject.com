@extends(auth()->user()->usertype === 'admin' ? 'layouts.admin' : (auth()->user()->usertype === 'professional' ? 'layouts.professional' : 'layouts.user'))

@section('content')
<style>
    .resource-table-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e8f0ec;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    }
    .resource-table-card .card-body {
        padding: 1.5rem;
    }
    .table thead th {
        border-bottom: 2px solid #e8f0ec;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.04em;
    }
    .table tbody tr:hover {
        background-color: #f9fafb;
    }
    .resource-meta {
        color: #6b7280;
        font-size: 0.9rem;
    }
    .btn-action {
        min-width: 90px;
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
                        <h5 class="card-title mb-1" style="color: #0f2c24;">{{ auth()->user()->usertype === 'admin' ? 'Manage All Resources' : 'Manage Your Resources' }}</h5>
                        <p class="text-muted mb-0">Review, edit or remove uploaded resources with one click.</p>
                    </div>
                    <a href="{{ route('resources.create') }}" class="btn btn-success">Add Resource</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="resource-table-card">
            <div class="card-body p-0">
                @if($resources->count())
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Author</th>
                                    <th>Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resources as $resource)
                                    <tr>
                                        <td>
                                            <strong>{{ $resource->title }}</strong>
                                            <div class="resource-meta mt-1">{{ \Illuminate\Support\Str::limit($resource->description ?? 'No description', 60) }}</div>
                                        </td>
                                        <td>{{ ucfirst(str_replace('-', ' ', $resource->category)) }}</td>
                                        <td>{{ ucfirst($resource->type) }}</td>
                                        <td>{{ $resource->user?->name ?? ($resource->posted_by_type === 'admin' ? 'Admin' : 'Professional') }}</td>
                                        <td>{{ $resource->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('resources.edit', $resource) }}" class="btn btn-outline-primary btn-sm btn-action me-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('resources.destroy', $resource) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-action">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-book-open"></i>
                        <h4>No Resources Found</h4>
                        <p>There are no resources to manage yet. Add a new resource to get started.</p>
                        <a href="{{ route('resources.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus me-1"></i>Add Resource
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if($resources->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $resources->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
