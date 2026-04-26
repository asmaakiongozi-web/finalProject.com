<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function appearance()
    {
        return view('admin.settings', [
            'activeSection' => 'appearance',
        ]);
    }

    public function account()
    {
        return view('admin.settings', [
            'activeSection' => 'account',
        ]);
    }

    public function saveAppearance(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|in:green,dark,light',
            'sidebar_style' => 'required|in:gradient,solid,soft',
            'sidebar_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'navbar_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'accent_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
        ]);

        session([
            'admin_appearance_theme' => $validated['theme'],
            'admin_sidebar_style' => $validated['sidebar_style'],
            'admin_sidebar_color' => $validated['sidebar_color'] ?? '#0f4c3a',
            'admin_navbar_color' => $validated['navbar_color'] ?? '#198754',
            'admin_accent_color' => $validated['accent_color'] ?? '#2c8c6b',
        ]);

        return redirect()->route('admin.settings.appearance')
            ->with('success', 'Appearance settings saved.');
    }

    public function saveAccount(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'current_password' => ['required', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        $user->name = $validated['name'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.settings.account')
            ->with('success', 'Account settings saved.');
    }
}