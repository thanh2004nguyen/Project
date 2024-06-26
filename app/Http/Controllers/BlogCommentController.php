<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function addComment(Request $request)
    {

        $illegalWords = json_decode(file_get_contents(public_path() . "/json/illegal_words.json"), true)["illegalText"];

        $recieveComment = explode(" ", $request->content);
        for ($i = 0; $i < count($recieveComment); $i++) {
            if (\in_array($recieveComment[$i], $illegalWords)) {
                $recieveComment[$i] = "***";
            }
        }
        $handledComment = "";
        $check = array_count_values($recieveComment);

        if (isset($check["***"])) {
            if ($check["***"] > 3) {
                $handledComment = "This comment illegal";
            } else {
                $handledComment = implode(
                    " ",
                    $recieveComment
                );
            }
        } else {
            $handledComment = implode(
                " ",
                $recieveComment
            );
        }



        BlogComment::create(
            [
                'content' => $handledComment,
                'user_id' => $request->user_id,
                'blog_id' => $request->blog_id,
            ]
        );

        return ('add successfully');
    }
    public function editComment(Request $request, $id)
    {

        $illegalWords = json_decode(file_get_contents(public_path() . "/json/illegal_words.json"), true)["illegalText"];

        $recieveComment = explode(" ", $request->content);
        for ($i = 0; $i < count($recieveComment); $i++) {
            if (\in_array($recieveComment[$i], $illegalWords)) {
                $recieveComment[$i] = "***";
            }
        }
        $handledComment = "";
        $check = array_count_values($recieveComment);

        if (isset($check["***"])) {
            if ($check["***"] > 3) {
                $handledComment = "This comment illegal";
            } else {
                $handledComment = implode(
                    " ",
                    $recieveComment
                );
            }
        } else {
            $handledComment = implode(
                " ",
                $recieveComment
            );
        }

        $comment =  BlogComment::find($id);
        $comment->comtent = $handledComment;
        $comment->save();
        return ('update successfully');
    }

    public function deleteComment($id)
    {
        $comment = BlogComment::find($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
