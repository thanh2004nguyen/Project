<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
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



        Comment::create(
            [
                'content' => $handledComment,
                'user_id' => $request->userid,
                'product_id' => $request->productid,

            ]
        );

        return ('add successfully');
    }
}
