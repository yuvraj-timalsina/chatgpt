<?php

namespace App\Http\Controllers;

    use App\Http\Requests\StoreChatRequest;

    class ChatGptStoreController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(StoreChatRequest $request)
        {
            $messages = [];
            $messages[] = ['role' => 'user', 'content' => $request->input('prompt')];
            dd($messages);
        }
    }
