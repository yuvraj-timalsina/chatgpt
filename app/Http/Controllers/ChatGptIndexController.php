<?php

namespace App\Http\Controllers;

    use App\Models\Chat;
    use Inertia\Inertia;
    use Inertia\Response;

    class ChatGptIndexController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(string $id = null): Response
        {
            return Inertia::render('Chat/ChatIndex', [
                'chat' => fn () => $id ? Chat::findOrFail($id) : null,
                'messages' => Chat::latest()->where('user_id', auth()->id())->get()
            ]);
        }
    }
