<?php

namespace Mong\TelegramChat\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $update = $request->all();
        Log::info('Received Telegram update:', $update);

        // Process the update using the SDK
        Telegram::commandsHandler(true);

        return response('OK', 200);
    }

    public function register()
    {
        $response = Telegram::setWebhook(['url' => config('telegram.bots.mybot.webhook_url')]);
        return response()->json([
            'success' => $response,
            'url' => config('telegram.bots.mybot.webhook_url'),
            "message" => "Webhook registered successfully"
        ]);
    }

    public function webhookInfo()
    {
        $response = Telegram::getWebhookInfo()->toArray();
        Log::info('Webhook info:', $response);
        return response()->json(['success' => $response]);
    }
}

