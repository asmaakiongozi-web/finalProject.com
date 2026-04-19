<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Community Forum - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }

        .sidebar-fixed {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1020;
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 1030;
            width: calc(100% - 280px);
        }

        .main-content {
            margin-left: 280px;
            margin-top: 64px;
            padding: 1.5rem;
            min-height: calc(100vh - 64px);
        }

        /* SIDEBAR STYLES */
        .sidebar-green {
            width: 280px;
            background: #0f2c24;
            background: linear-gradient(180deg, #0f2c24 0%, #0a241d 100%);
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05);
            border-right: 1px solid #2c5443;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-green::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-green::-webkit-scrollbar-track {
            background: #1e3f34;
        }
        .sidebar-green::-webkit-scrollbar-thumb {
            background: #5f9e82;
            border-radius: 10px;
        }

        .sidebar-inner {
            padding: 1.8rem 1rem 2rem 1rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 0.75rem 1.25rem 0.75rem;
            margin-bottom: 1.8rem;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }
        .sidebar-brand i {
            font-size: 1.9rem;
            color: #c0e0d2;
        }
        .sidebar-brand span {
            font-size: 1.35rem;
            font-weight: 600;
            letter-spacing: -0.2px;
            color: white;
        }
        .sidebar-brand small {
            font-size: 0.7rem;
            font-weight: 400;
            color: #bcd9cd;
            display: block;
            margin-top: 2px;
        }

        .nav-green {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            list-style: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
        }

        .nav-green .nav-item {
            list-style: none;
        }

        .nav-green .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.9rem;
            color: #e2efea;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            line-height: 1.4;
        }

        .nav-green .nav-link-custom i {
            width: 24px;
            font-size: 1.15rem;
            text-align: center;
            color: #c0dfd0;
        }

        .nav-green .nav-link-custom .dropdown-icon {
            margin-left: auto;
            font-size: 0.7rem;
            transition: transform 0.2s;
        }

        .nav-green .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }
        .nav-green .nav-link-custom:hover i {
            color: white;
        }

        .nav-green .nav-link-custom.active {
            background: #2d7a5c;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .nav-green .nav-link-custom.active i {
            color: white;
        }

        .dropdown-menu-custom {
            list-style: none;
            padding-left: 2.6rem;
            margin-top: 0.3rem;
            margin-bottom: 0.2rem;
            display: none;
            border-left: 2px solid #3f8268;
            margin-left: 1rem;
        }
        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom li {
            margin-bottom: 0.3rem;
        }

        .dropdown-menu-custom .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 0.9rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 450;
            color: #d2e6dd;
            text-decoration: none;
            transition: all 0.2s;
        }
        .dropdown-menu-custom .dropdown-link i {
            width: 20px;
            font-size: 0.8rem;
            color: #b1dbc9;
        }
        .dropdown-menu-custom .dropdown-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.1rem;
        }

        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 0.8rem 0.75rem;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            font-size: 0.7rem;
            text-align: center;
            color: #96bbaa;
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 0.5rem;
        }

        /* Community content styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        .card-header {
            border: none;
            background-color: white;
            border-radius: 12px 12px 0 0;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 122, 92, 0.3);
        }

        .tabs-nav {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 1.5rem;
        }
        .tabs-nav button {
            padding: 0.8rem 1.5rem;
            background: none;
            border: none;
            color: #666;
            font-weight: 500;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        .tabs-nav button:hover {
            color: #2d7a5c;
        }
        .tabs-nav button.active {
            color: #2d7a5c;
            border-bottom-color: #2d7a5c;
        }

        .discussion-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: white;
            transition: all 0.2s;
        }
        .discussion-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-color: #2d7a5c;
        }
        .discussion-title {
            color: #0f2c24;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .discussion-author {
            color: #2d7a5c;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .discussion-time {
            color: #999;
            font-size: 0.85rem;
        }
        .discussion-category {
            display: inline-block;
            background: rgba(45, 122, 92, 0.1);
            color: #2d7a5c;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }
        .discussion-content {
            color: #333;
            margin-top: 1rem;
            line-height: 1.6;
            word-break: break-word;
        }
        .discussion-stats {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
        .discussion-actions {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 0.5rem;
        }
        .discussion-actions button {
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }

        .reply-card {
            border: 1px solid #e8f0ec;
            border-radius: 10px;
            background: #fbfffb;
            padding: 1rem;
            margin-top: 1rem;
        }
        .reply-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            color: #2d7a5c;
            font-weight: 600;
        }
        .reply-author {
            color: #2d7a5c;
        }
        .reply-time {
            color: #7a7a7a;
            font-size: 0.85rem;
        }
        .reply-content {
            color: #333;
            margin-top: 0.75rem;
            line-height: 1.6;
        }
        .reply-form {
            margin-top: 1rem;
        }
        .reply-textarea {
            width: 100%;
            min-height: 120px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            resize: vertical;
        }
        .reply-controls {
            margin-top: 0.75rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .new-discussion-form {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #999;
        }
        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="font-sans antialiased">
    {{-- Include Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Include Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Page content --}}
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 style="color: #0f2c24; font-weight: 600;">
                        <i class="fas fa-comments me-2" style="color: #2d7a5c;"></i>Community Forum
                    </h3>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="tabs-nav">
                        <button class="tab-btn active" data-tab="new-post">
                            <i class="fas fa-plus me-2"></i>Create Discussion
                        </button>
                        <button class="tab-btn" data-tab="today">
                            <i class="fas fa-clock me-2"></i>Today's Discussions
                        </button>
                        <button class="tab-btn" data-tab="recent">
                            <i class="fas fa-fire me-2"></i>Recent Discussions
                        </button>
                        <button class="tab-btn" data-tab="my-posts">
                            <i class="fas fa-user-check me-2"></i>My Posts
                        </button>
                    </div>
                </div>
            </div>

            <!-- Create New Discussion Tab -->
            <div id="new-post-tab" class="tab-content active">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-3">
                                <h5 class="mb-0" style="color: #0f2c24; font-weight: 600;">
                                    <i class="fas fa-pencil-alt me-2" style="color: #2d7a5c;"></i>Start a New Discussion
                                </h5>
                            </div>
                            <div class="card-body">
                                <form id="discussionForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #0f2c24; font-weight: 500;">Discussion Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="What would you like to discuss?" style="border-radius: 8px; border: 2px solid #e0e0e0;">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #0f2c24; font-weight: 500;">Description</label>
                                        <textarea name="content" class="form-control" rows="6" placeholder="Share your thoughts, questions, or experiences with the community..." style="border-radius: 8px; border: 2px solid #e0e0e0; font-family: 'Inter', sans-serif;"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" style="color: #0f2c24; font-weight: 500;">Category (Optional)</label>
                                        <select name="category" class="form-select" style="border-radius: 8px; border: 2px solid #e0e0e0;">
                                            <option value="general">General Discussion</option>
                                            <option value="anxiety">Anxiety & Stress</option>
                                            <option value="stress">Stress Management</option>
                                            <option value="depression">Mental Health</option>
                                            <option value="relationships">Relationships</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn" style="background-color: #2d7a5c; color: white; font-weight: 600;">
                                            <i class="fas fa-paper-plane me-2"></i>Post Discussion
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Clear
                                        </button>
                                    </div>
                                </form>

                                <div id="postMessage" style="margin-top: 1rem; display: none;" class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>Discussion posted successfully!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Discussions Tab -->
            <div id="today-tab" class="tab-content" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <div id="todayList">
                            <div class="empty-state">
                                <i class="fas fa-calendar-times"></i>
                                <p>No discussions posted today. Be the first to start a conversation!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Discussions Tab -->
            <div id="recent-tab" class="tab-content" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <div id="recentList">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>No discussions yet. Create one to get started!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Posts Tab -->
            <div id="my-posts-tab" class="tab-content" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <div id="myPostsList">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>You haven't posted any discussions yet. Share your thoughts!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script>
        (function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const currentUserId = {{ auth()->id() ?? 'null' }};
            const currentUserIdNum = currentUserId ? parseInt(currentUserId) : null;

            // Tab switching
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tabName = this.getAttribute('data-tab');
                    
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(t => t.style.display = 'none');
                    
                    this.classList.add('active');
                    document.getElementById(tabName + '-tab').style.display = 'block';
                    
                    // Load appropriate data when switching tabs
                    if (tabName === 'today') loadTodayDiscussions();
                    if (tabName === 'recent') loadRecentDiscussions();
                    if (tabName === 'my-posts') loadMyPosts();
                });
            });

            // Form submission
            const discussionForm = document.getElementById('discussionForm');
            const postMessage = document.getElementById('postMessage');

            discussionForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const title = this.querySelector('[name="title"]').value;
                const content = this.querySelector('[name="content"]').value;
                const category = this.querySelector('[name="category"]').value;

                if (!title.trim() || !content.trim()) {
                    alert('Please fill in all required fields.');
                    return;
                }

                fetch('{{ route("community.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        title: title,
                        content: content,
                        category: category
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        discussionForm.reset();
                        postMessage.style.display = 'block';
                        setTimeout(() => {
                            postMessage.style.display = 'none';
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error posting discussion.');
                });
            });

            // Load today's discussions
            function loadTodayDiscussions() {
                fetch('{{ route("community.today") }}')
                    .then(response => response.json())
                    .then(discussions => displayDiscussions(discussions, 'todayList'))
                    .catch(error => console.error('Error:', error));
            }

            // Load recent discussions
            function loadRecentDiscussions() {
                fetch('{{ route("community.recent") }}')
                    .then(response => response.json())
                    .then(discussions => displayDiscussions(discussions, 'recentList'))
                    .catch(error => console.error('Error:', error));
            }

            // Load my posts
            function loadMyPosts() {
                fetch('{{ route("community.myPosts") }}')
                    .then(response => response.json())
                    .then(discussions => displayDiscussions(discussions, 'myPostsList'))
                    .catch(error => console.error('Error:', error));
            }

            // Display discussions
            function displayDiscussions(discussions, containerId) {
                const container = document.getElementById(containerId);

                if (discussions.length === 0) {
                    const isEmpty = containerId === 'todayList' ? 'No discussions posted today. Be the first to start a conversation!' :
                                   containerId === 'recentList' ? 'No discussions yet. Create one to get started!' :
                                   'You haven\'t posted any discussions yet. Share your thoughts!';
                    container.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>${isEmpty}</p>
                        </div>
                    `;
                    return;
                }

                container.innerHTML = '';
                discussions.forEach(discussion => {
                    const date = new Date(discussion.timestamp);
                    const dateStr = date.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric' 
                    });
                    const timeStr = date.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    });

                    const replyCount = discussion.replies ? discussion.replies.length : 0;

                    const repliesHtml = (discussion.replies && discussion.replies.length) ? discussion.replies.map(reply => `
                        <div class="reply-card">
                            <div class="reply-header">
                                <span class="reply-author"><i class="fas fa-user me-1"></i>${reply.author_label}</span>
                                <span class="reply-time">${new Date(reply.timestamp).toLocaleString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</span>
                            </div>
                            <div class="reply-content">${reply.content}</div>
                            ${reply.user_id === currentUserIdNum ? `
                                <button class="btn btn-sm btn-outline-danger delete-reply-btn mt-3" data-discussion-id="${discussion.id}" data-reply-id="${reply.id}">
                                    <i class="fas fa-trash me-1"></i>Delete Reply
                                </button>
                            ` : ''}
                        </div>
                    `).join('') : `
                        <div class="empty-state" style="padding: 1rem; color: #777;">
                            <p>No replies yet. Be the first to respond.</p>
                        </div>
                    `;

                    const discussionHtml = `
                        <div class="discussion-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div style="flex: 1;">
                                    <div class="discussion-title">${discussion.title}</div>
                                    <div style="margin-top: 0.3rem;">
                                        <span class="discussion-author"><i class="fas fa-user me-1"></i>${discussion.author_label}</span>
                                        <span class="discussion-time ms-2"><i class="fas fa-clock me-1"></i>${dateStr} at ${timeStr}</span>
                                        <span class="discussion-category">${discussion.category}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="discussion-content">
                                ${discussion.content}
                            </div>
                            <div class="discussion-stats">
                                <span><i class="fas fa-eye me-1" style="color: #2d7a5c;"></i>${discussion.views || 0} views</span>
                                <span><i class="fas fa-comments me-1" style="color: #2d7a5c;"></i>${replyCount} replies</span>
                            </div>
                            <div class="discussion-actions">
                                <button class="btn btn-sm btn-outline-primary reply-btn" data-id="${discussion.id}">
                                    <i class="fas fa-reply me-1"></i>Reply
                                </button>
                                ${discussion.user_id === currentUserIdNum ? `
                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${discussion.id}">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                                ` : ''}
                            </div>
                            <div class="reply-form" id="reply-form-${discussion.id}">
                                ${repliesHtml}
                                <form class="reply-form-element" data-discussion-id="${discussion.id}">
                                    <textarea id="replyTextarea-${discussion.id}" class="reply-textarea" name="replyContent" placeholder="Write your response..." required></textarea>
                                    <div class="reply-controls">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-paper-plane me-1"></i>Post Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    `;

                    container.innerHTML += discussionHtml;
                });

                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        if (confirm('Are you sure you want to delete this discussion?')) {
                            deleteDiscussion(id);
                        }
                    });
                });

                document.querySelectorAll('.delete-reply-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const discussionId = this.getAttribute('data-discussion-id');
                        const replyId = this.getAttribute('data-reply-id');
                        if (confirm('Delete this reply?')) {
                            deleteReply(discussionId, replyId);
                        }
                    });
                });

                document.querySelectorAll('.reply-form-element').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const discussionId = this.getAttribute('data-discussion-id');
                        const content = this.querySelector('[name="replyContent"]').value;

                        if (!content.trim()) {
                            alert('Please add a reply before posting.');
                            return;
                        }

                        postReply(discussionId, content);
                    });
                });

                document.querySelectorAll('.reply-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const discussionId = this.getAttribute('data-id');
                        const textarea = document.getElementById(`replyTextarea-${discussionId}`);
                        if (textarea) {
                            textarea.focus();
                        }
                    });
                });
            }

            // Delete discussion
            function deleteDiscussion(id) {
                fetch(`{{ url('community') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const activeTab = document.querySelector('.tab-btn.active');
                        activeTab.click();
                    } else {
                        alert(data.message || 'Error deleting discussion.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting discussion.');
                });
            }

            function postReply(discussionId, content) {
                fetch(`{{ url('community') }}/${discussionId}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ content: content })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const activeTab = document.querySelector('.tab-btn.active');
                        activeTab.click();
                    } else {
                        alert(data.message || 'Error posting reply.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error posting reply.');
                });
            }

            function deleteReply(discussionId, replyId) {
                const url = `{{ url('community') }}/${discussionId}/reply/${replyId}`;

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const activeTab = document.querySelector('.tab-btn.active');
                        activeTab.click();
                    } else {
                        alert(data.message || 'Error deleting reply.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting reply.');
                });
            }

            // Sidebar active state
            const communityLink = document.querySelector('a[href*="community"]');
            if (communityLink) {
                document.querySelectorAll('.nav-link-custom').forEach(link => link.classList.remove('active'));
                communityLink.classList.add('active');
            }
        })();
    </script>
</body>
</html>
