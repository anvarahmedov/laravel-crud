<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user) {
        $ideas = $user->ideas()->paginate(5);
        return view('admin.users.show', compact('user', 'ideas'));
    }

    public function edit(User $user) {
        $ideas = $user->ideas()->paginate(5);
        return view('admin.users.edit', compact('user', 'ideas'));
    }
}
