@extends('layout.layout')
<!DOCTYPE html>
<html lang="EN">
@section('title', 'Ideas | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Ideas</h1>
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->user_id }}</td>
                            <td>
                                <a href = "{{ route('users.show', $idea->user->id) }}">{{ $idea->user->name }}
                                </a>
                            </td>
                            <td>
                                <a href = "{{ route('ideas.show', $idea->id) }}">{{ $idea->content }}
                                </a>
                            </td>
                            <td>{{ $idea->created_at->toDateString() }}</td>
                            <td>
                                <a href = "{{ route('ideas.show', $idea) }}">View</a>
                                <a href = "{{ route('ideas.edit', $idea) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $ideas->links() }}
            </div>

        </div>


    </div>
@endsection
