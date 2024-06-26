<?php

namespace App\Http\Controllers;

use App\Models\BlogReplyComment;
use Illuminate\Http\Request;

class BlogReplyCommentController extends Controller
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



        BlogReplyComment::create(
            [
                'content' => $handledComment,
                'user_id' => $request->user_id,
                'blogComment_id' => $request->blogComment_id,
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

        $comment =  BlogReplyComment::find($id);
        $comment->comtent = $handledComment;
        $comment->save();
        return ('update successfully');
    }

    public function deleteComment($id)
    {
        $comment = BlogReplyComment::find($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
