<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Display the community forum page.
     */
    public function index()
    {
        return view('community');
    }

    /**
     * Get today's discussions.
     */
    public function todayDiscussions()
    {
        $today = now()->format('Y-m-d');

        $discussions = Discussion::with('replies')
            ->whereDate('created_at', $today)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Discussion $discussion) => $this->serializeDiscussion($discussion));

        return response()->json($discussions);
    }

    /**
     * Get recent discussions.
     */
    public function recentDiscussions()
    {
        $discussions = Discussion::with('replies')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Discussion $discussion) => $this->serializeDiscussion($discussion));

        return response()->json($discussions);
    }

    /**
     * Get user's own posts.
     */
    public function myPosts()
    {
        $userId = auth()->id();

        $discussions = Discussion::with('replies')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Discussion $discussion) => $this->serializeDiscussion($discussion));

        return response()->json($discussions);
    }

    /**
     * Create a new discussion post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|in:general,anxiety,stress,depression,relationships,other',
        ]);

        $authorId = auth()->id();

        $discussion = Discussion::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'] ?? 'general',
            'user_id' => $authorId,
            'author_label' => $this->getAnonymousUserLabel($authorId),
            'views' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Discussion posted successfully!',
            'discussion' => $this->serializeDiscussion($discussion),
        ]);
    }

    /**
     * Reply to a discussion.
     */
    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $discussion = Discussion::find($id);
        if (! $discussion) {
            return response()->json([
                'success' => false,
                'message' => 'Discussion not found.',
            ], 404);
        }

        $reply = $discussion->replies()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'author_label' => $this->getAnonymousUserLabel(auth()->id()),
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

    /**
     * Delete a discussion.
     */
    public function destroy($id)
    {
        $discussion = Discussion::find($id);
        if (! $discussion) {
            return response()->json([
                'success' => false,
                'message' => 'Discussion not found.',
            ], 404);
        }

        if ($discussion->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this discussion.',
            ], 403);
        }

        $discussion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Discussion deleted successfully!',
        ]);
    }

    /**
     * Delete a reply.
     */
    public function destroyReply($discussionId, $replyId)
    {
        $discussion = Discussion::find($discussionId);
        if (! $discussion) {
            return response()->json([
                'success' => false,
                'message' => 'Discussion not found.',
            ], 404);
        }

        $reply = $discussion->replies()->where('id', $replyId)->first();
        if (! $reply) {
            return response()->json([
                'success' => false,
                'message' => 'Reply not found.',
            ], 404);
        }

        if ($reply->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this reply.',
            ], 403);
        }

        $reply->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reply deleted successfully!',
        ]);
    }

    /**
     * Serialize a discussion for JSON response.
     */
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
            'replies' => $discussion->replies->map(fn (DiscussionReply $reply) => [
                'id' => $reply->id,
                'content' => $reply->content,
                'author_label' => $reply->author_label,
                'user_id' => $reply->user_id,
                'timestamp' => $reply->created_at->toIso8601String(),
            ])->toArray(),
        ];
    }

    /**
     * Retrieve or assign an anonymous label per user.
     */
    private function getAnonymousUserLabel($userId): string
    {
        if (! $userId) {
            return 'Anonymous';
        }

        $existingLabel = Discussion::where('user_id', $userId)->value('author_label')
            ?? DiscussionReply::where('user_id', $userId)->value('author_label');

        if ($existingLabel) {
            return $existingLabel;
        }

        $userIds = Discussion::whereNotNull('user_id')->pluck('user_id')
            ->merge(DiscussionReply::whereNotNull('user_id')->pluck('user_id'))
            ->unique();

        return 'Anonymous ' . ($userIds->count() + 1);
    }
}
