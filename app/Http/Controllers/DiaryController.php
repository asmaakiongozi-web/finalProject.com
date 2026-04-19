<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
{
    /**
     * Display the diary page.
     */
    public function index()
    {
        return view('diary');
    }

    /**
     * Store a diary entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'mood' => 'nullable|string|in:very-sad,sad,neutral,happy,very-happy',
        ]);

        // Add timestamp
        $validated['timestamp'] = now()->toIso8601String();
        $validated['id'] = time();

        // Get existing entries from session or initialize empty array
        $entries = session()->get('diary_entries', []);
        
        // Add new entry to the beginning
        array_unshift($entries, $validated);

        // Store back to session
        session()->put('diary_entries', $entries);

        return response()->json([
            'success' => true,
            'message' => 'Diary entry saved successfully!',
            'entry' => $validated
        ]);
    }

    /**
     * Get all diary entries.
     */
    public function getEntries()
    {
        $entries = session()->get('diary_entries', []);
        return response()->json($entries);
    }

    /**
     * Delete a diary entry.
     */
    public function destroy($id)
    {
        $entries = session()->get('diary_entries', []);
        
        $entries = array_filter($entries, function($entry) use ($id) {
            return $entry['id'] != $id;
        });

        session()->put('diary_entries', array_values($entries));

        return response()->json([
            'success' => true,
            'message' => 'Entry deleted successfully!'
        ]);
    }
}
