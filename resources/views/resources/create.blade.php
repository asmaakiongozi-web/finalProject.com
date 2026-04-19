@extends(auth()->user()->usertype === 'professional' ? 'layouts.professional' : 'layouts.user')

@section('content')
<style>
    .resource-form-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e8f0ec;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    }
    .resource-form-card .card-body {
        padding: 2rem;
    }
    .form-label {
        font-weight: 600;
        color: #0f2c24;
    }
    .form-control,
    .form-select {
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        min-height: 48px;
    }
    .file-help {
        font-size: 0.9rem;
        color: #6b7280;
    }
    .resource-form-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1" style="color: #0f2c24; font-weight: 700;">Add New Resource</h1>
        <p class="text-muted mb-0">Create a new resource for the community.</p>
    </div>
    <a href="{{ route('resources.manage') }}" class="btn btn-outline-secondary">Manage Resources</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="resource-form-card">
    <div class="card-body">
        <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="category">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        @foreach(['general','anxiety','depression','stress','relationships','self-care','coping-skills'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="type">Resource Type</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="article" {{ old('type') === 'article' ? 'selected' : '' }}>Article</option>
                        <option value="audio" {{ old('type') === 'audio' ? 'selected' : '' }}>Audio</option>
                        <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video</option>
                        <option value="pdf" {{ old('type') === 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="link" {{ old('type') === 'link' ? 'selected' : '' }}>Link</option>
                    </select>
                    @error('type')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="description">Short Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label" for="content">Content / Link</label>
                    <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                    <div class="file-help">For articles, enter text content. For video or link resources, paste the URL. For PDFs, upload a file below.</div>
                    @error('content')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="file">Upload File</label>
                    <input type="file" name="file" id="file" class="form-control">
                    <div class="file-help">Supported formats: pdf, doc, docx. Max size: 50MB.</div>
                    @error('file')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="resource-form-actions">
                <button type="submit" class="btn btn-success">Save Resource</button>
                <a href="{{ route('resources.manage') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
