<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function __construct()
    {
        // Protect all routes
        $this->middleware('auth');
    }

    public function index()
    {
        return view('community');
    }

    public function todayDiscussions()
    {
        $discussions = Discussion::with('replies')
            ->whereDate('created_at', now())
            ->latest()
            ->get()
            ->map(fn ($d) => $this->serializeDiscussion($d));

        return response()->json($discussions);
    }

    public function recentDiscussions()
    {
        $discussions = Discussion::with('replies')
            ->latest()
            ->get()
            ->map(fn ($d) => $this->serializeDiscussion($d));

        return response()->json($discussions);
    }

    public function myPosts()
    {
        $userId = Auth::id();

        $discussions = Discussion::with('replies')
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->map(fn ($d) => $this->serializeDiscussion($d));

        return response()->json($discussions);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|in:general,anxiety,stress,depression,relationships,other',
        ]);

        $discussion = Discussion::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'] ?? 'general',
            'user_id' => $userId,
            'author_label' => $this->getAnonymousUserLabel($userId),
            'views' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Discussion posted successfully!',
            'discussion' => $this->serializeDiscussion($discussion),
        ]);
    }

    public function reply(Request $request, $id)
    {
        $discussion = Discussion::findOrFail($id);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $reply = $discussion->replies()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'author_label' => $this->getAnonymousUserLabel(Auth::id()),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reply posted successfully!',
            'reply' => [
                'id' => $reply->id,
                'content' => $reply->content,
                'author_label' => $reply->author_label,
                'user_id' => $reply->user_id,
                'timestamp' => $reply->created_at->toIso8601String(),
            ],
        ]);
    }

    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id);

        if ($discussion->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $discussion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully',
        ]);
    }

    public function destroyReply($discussionId, $replyId)
    {
        $reply = DiscussionReply::where('discussion_id', $discussionId)
            ->where('id', $replyId)
            ->firstOrFail();

        if ($reply->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $reply->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reply deleted successfully',
        ]);
    }

    private function serializeDiscussion(Discussion $discussion): array
    {
        return [
            'id' => $discussion->id,
            'title' => $discussion->title,
            'content' => $discussion->content,
            'category' => $discussion->category,
            'author_label' => $discussion->author_label,
            'user_id' => $discussion->user_id,
            'timestamp' => $discussion->created_at->toIso8601String(),
            'views' => $discussion->views,
            'replies' => $discussion->replies->map(fn ($r) => [
                'id' => $r->id,
                'content' => $r->content,
                'author_label' => $r->author_label,
                'user_id' => $r->user_id,
                'timestamp' => $r->created_at->toIso8601String(),
            ]),
        ];
    }

    private function getAnonymousUserLabel($userId): string
    {
        if (!$userId) return 'Anonymous';

        // Check existing label
        $label = Discussion::where('user_id', $userId)->value('author_label')
            ?? DiscussionReply::where('user_id', $userId)->value('author_label');

        if ($label) return $label;

        // Generate new label (simple + fast)
        $count = Discussion::distinct('user_id')->count('user_id')
            + DiscussionReply::distinct('user_id')->count('user_id');

        return 'Anonymous ' . ($count + 1);
    }
}