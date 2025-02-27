<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateGithub(Request $request)
    {
        $validatedData = $request->validate([
            'githubProfile' => 'required'
        ]);

        $request->user()->update($validatedData);

        return redirect()->back()->with('success', 'GitHub profile updated successfully!');
    }

    public function updateSkills(Request $request)
    {

        $validatedData = $request->validate([
            'skills' => 'nullable|string',
        ]);
        if (isset($validatedData['skills']) && $validatedData['skills']) {
            $validatedData['skills'] = array_map('trim', explode(',', $validatedData['skills']));
        } else {
            $validatedData['skills'] = [];
        }

        if (!$request->user()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }

        $request->user()->update($validatedData);

        return redirect()->back()->with('success', 'Skills updated successfully!');
    }
    public function updateLanguages(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'languages' => 'nullable|string',
        ]);
    
        // Process languages
        $languages = isset($validatedData['languages']) ? array_map('trim', explode(',', $validatedData['languages'])) : [];
    
        // Check for empty values
        if (array_filter($languages) !== $languages) {
            return redirect()->back()->withErrors(['error' => 'Invalid language format. Please separate languages with commas.']);
        }
    
        // Check user authentication
        if (!$request->user()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
    
        // Update languages
        try {
            $request->user()->update(['languages' => $languages]);
            return redirect()->back()->with('success', 'Languages updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update languages. Please try again.']);
        }
    }
    
}
