<?php

namespace App\Http\Controllers;

    use App\Http\Requests\StoreChatRequest;
    use App\Models\Chat;
    use OpenAI\Laravel\Facades\OpenAI;

    class ChatGptStoreController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(StoreChatRequest $request, string $id = null)
        {
            $messages = [];
            if ($id) {
                $chat = Chat::findOrFail($id);
                $messages = $chat->context;
            }
            $messages[] = ['role' => 'user', 'content' => $request->input('prompt')];
            $response = OpenAI::chat()->create(['model' => 'gpt-3.5-turbo', 'messages' => $messages]);
            $messages[] = ['role' => 'assistant', 'content' => $response->choices[0]->message->content];

            $chat = Chat::updateOrCreate(['id' => $id, 'user_id' => auth()->id()], ['context' => $messages]);

            return to_route('chat.show', [$chat->id]);
        }
    }
