<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class AdminChatController extends Controller
{
    public function __invoke(Request $request)
    {
        $chats = Chat::withCount('unseen_messages')->orderBy('unseen_messages_count', 'desc')->paginate(10);
        return view('chat.messages', [
            'chats' => $chats
        ]);
    }
}
