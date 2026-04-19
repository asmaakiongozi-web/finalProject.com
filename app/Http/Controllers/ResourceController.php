<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the resource library for users.
     */
    public function index()
    {
        $resources = Resource::with('user')
            ->latest()
            ->paginate(12);

        $category = null; // No specific category filter

        return view('resources.index', compact('resources', 'category'));
    }

    /**
     * Show a specific resource.
     */
    public function show(Resource $resource)
    {
        // Increment view count if needed (optional)
        return view('resources.show', compact('resource'));
    }

    /**
     * Display resources by category.
     */
    public function category($category)
    {
        $resources = Resource::with('user')
            ->where('category', $category)
            ->latest()
            ->paginate(12);

        return view('resources.index', compact('resources', 'category'));
    }

    /**
     * Display resources by media type.
     */
    public function type($type)
    {
        $resources = Resource::with('user')
            ->where('type', $type)
            ->latest()
            ->paginate(12);

        $category = null;

        return view('resources.index', compact('resources', 'category'))->with('type', $type);
    }

    /**
     * Store a new resource (for professionals and admins only).
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user is professional or admin
        if (!in_array($user->usertype, ['professional', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category' => 'required|string|in:general,anxiety,depression,stress,relationships,self-care,coping-skills',
            'type' => 'required|string|in:article,video,audio,pdf,link',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:51200', // 50MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resources', 'public');
        }

        Resource::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'type' => $validated['type'],
            'file_path' => $filePath,
            'posted_by' => $user->id,
            'posted_by_type' => $user->usertype,
        ]);

        return redirect()->back()->with('success', 'Resource posted successfully!');
    }

    /**
     * Show the form for creating a new resource (professionals/admins only).
     */
    public function create()
    {
        $user = Auth::user();
        if (!in_array($user->usertype, ['professional', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        return view('resources.create');
    }

    /**
     * Display resources management for professionals/admins.
     */
    public function manage()
    {
        $user = Auth::user();
        if (!in_array($user->usertype, ['professional', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        $resources = Resource::where('posted_by', $user->id)
            ->latest()
            ->paginate(10);

        return view('resources.manage', compact('resources'));
    }

    /**
     * Delete a resource (only by the poster).
     */
    public function destroy(Resource $resource)
    {
        if ($resource->posted_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Delete file if exists
        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->back()->with('success', 'Resource deleted successfully!');
    }
}
