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

        $validatedData = $request->validate([
            'languages' => 'nullable|string',
        ]);

        $languages = isset($validatedData['languages']) ? array_map('trim', explode(',', $validatedData['languages'])) : [];

        if (array_filter($languages) !== $languages) {
            return redirect()->back()->withErrors(['error' => 'Invalid language format. Please separate languages with commas.']);
        }


        if (!$request->user()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
        try {
            $request->user()->update(['languages' => $languages]);
            return redirect()->back()->with('success', 'Languages updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update languages. Please try again.']);
        }
    }

    public function updateProjects(Request $request)
    {
        $validatedData = $request->validate([
            'projects' => 'nullable|array',
            'projects.*.title' => 'required|string|max:255',
            'projects.*.date' => 'required|date',
            'projects.*.endDate' => 'nullable|date|after_or_equal:projects.*.date',
            'projects.*.description' => 'required|string|max:1000',
            'projects.*.link' => 'nullable|url',
            'projects.*.languages' => 'nullable|string',
        ]);

        if (!$request->user()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }

        try {
            // Retrieve existing projects from the database
            $existingProjects = $request->user()->projects ?? [];

            // Format new projects into an array
            $newProjects = [];
            foreach ($validatedData['projects'] as $project) {
                $newProjects[] = [
                    'title' => trim($project['title']),
                    'date' => trim($project['date']),
                    'endDate' => isset($project['endDate']) ? trim($project['endDate']) : null,
                    'description' => trim($project['description']),
                    'link' => isset($project['link']) ? trim($project['link']) : null,
                    'languages' => isset($project['languages']) ? array_map('trim', explode(',', $project['languages'])) : [],
                ];
            }

            // Merge new projects with existing ones
            $updatedProjects = array_merge($existingProjects, $newProjects);

            // Update the user's projects
            $request->user()->update(['projects' => $updatedProjects]);

            return redirect()->back()->with('success', 'Projects updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update projects. Please try again.']);
        }
    }

    public function projectEdit(Request $request, $index)
    {
        $projects = $request->user()->projects;
        return view('profile', [
            'projects' => $projects,
            'editIndex' => (int)$index
        ]);
    }


    public function projectUpdate(Request $request, $index)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'endDate' => 'nullable|date',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $projects = $request->user()->projects;
        $projects[$index] = [
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'endDate' => $request->input('endDate'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'languages' => $projects[$index]['languages']
        ];

        $request->user()->update(['projects' => $projects]);

        return redirect()->route('profileView')->with('success', 'Project updated successfully.');
    }


    public function deleteProject($index)
    {
        $user = Auth::user();

        if (!isset($user->projects[$index])) {
            return redirect()->back()->withErrors(['error' => 'Project not found.']);
        }

        $projects = $user->projects;
        array_splice($projects, $index, 1);

        $user->update(['projects' => $projects]);

        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
}
