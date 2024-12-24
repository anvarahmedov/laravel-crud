<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $editting = true;
        $ideas = $user->ideas()->paginate(5);
        return view('users.edit')->with('user', $user)->with('editting', $editting)->with('ideas', $ideas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();
            if ($request->has('image')) {
                $imagePath = $request->file('image')->store('profile', 'public');
                $validated['image'] = $imagePath;

                Storage::disk('public')->delete($user->image ?? "");
            }

            $user->update($validated);
            return redirect()->route('profile');
    }

    public function profile() {
        return $this->show(Auth::user());
    }
}
