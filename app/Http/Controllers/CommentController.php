<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function destroy(Comment $comment)
{
    $post = $comment->post;

    $comment->delete();

    return redirect()->route('post', $post)->with('success', 'Comment deleted.');
}

}