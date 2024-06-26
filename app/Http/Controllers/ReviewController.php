<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ReviewController extends Controller
{
    public function listReview()
    
    {
        $id = Session::get('admin_id');
        $admin = User::find($id);  
        $reviews = Review::with('user', 'product')->get();
        return view('admin.Comment.list_review', compact('reviews','admin'));
    }

    public function deleteComment($id)
    {
        $comment = Review::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
    public function replyComment(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->admin_comment = $request->input('admin_comment');
        $review->save();

        return redirect()->back()->with('success', 'Đã trả lời comment thành công');
    }
}
