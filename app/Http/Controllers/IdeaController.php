<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Idea;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;

class IdeaController extends Controller
{
    public function show(Idea $idea) {


        return view("ideas.show", compact("idea"));

    }
    public function store(CreateIdeaRequest $request) {


        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        Idea::create($validated);
        return redirect()->route('dashboard')->with('success', 'Idea created successfully');
    }

    public function update(UpdateIdeaRequest $request, Idea $idea) {

        $validated = $request->validated();

        $idea->update($validated);
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully');
    }

    public function destroy(Idea $idea) {
        if (Gate::denies('idea.delete', $idea) && !auth()->user()->is_admin && auth()->user()->id != $idea->user_id) {
            return abort(403, "This action is unauthorized");
        }

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }

    public function edit($id) {
        $idea = Idea::findOrFail($id);
        if (Gate::denies('idea.edit', $idea) && !auth()->user()->is_admin && auth()->user()->id != $idea->user_id) {
            return abort(403, "This action is unauthorized");
        }
        $idea = Idea::where('id', $id)->firstOrFail();
        $editting = true;
        return view("ideas.show", compact('idea', 'editting'));
        }
}
