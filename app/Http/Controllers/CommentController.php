<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Idea;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{
    public function store(Idea $idea) {

    $validator = Validator::make(request()->all(), [
            'content' => 'required'
    ]);
    if ($validator->fails()) {
        return redirect()->back();
    }
    $comment = new Comment();
    $comment->idea_id = $idea->id;
    $comment->user_id = $idea->user_id;
    $comment->content = request()->get('content');
    $comment->save();



    return redirect()->route('ideas.show', $idea->id)->with('success','Comment posted successfully');
    }
}
