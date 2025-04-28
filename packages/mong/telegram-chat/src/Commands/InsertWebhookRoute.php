<?php

declare(strict_types=1);

namespace Mong\TelegramChat\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class InsertWebhookRoute extends Command
{
    protected $signature = 'telegram-chat:insert-webhook-route';
    protected $description = 'Insert Telegram webhook route into routes/api.php if not present';

    public function handle(): int
    {
        $route = <<<ROUTE

Route::prefix('telegram')->group(function () {
    Route::prefix('webhook')->group(function () {
        Route::post('/', [\\Mong\\TelegramChat\\Controllers\\TelegramWebhookController::class, 'handle']);
        Route::get('/register', [\\Mong\\TelegramChat\\Controllers\\TelegramWebhookController::class, 'register']);
        Route::get('/webhook-info', [\\Mong\\TelegramChat\\Controllers\\TelegramWebhookController::class, 'webhookInfo']);
    });
});
ROUTE; 

        $file = base_path('routes/api.php');
        $contents = File::get($file);

        if (str_contains($contents, "TelegramWebhookController::class")) {
            $this->info('Webhook routes already exist in routes/api.php.');
            return self::SUCCESS;
        }

        // Find the last use statement
        $pattern = '/(use [^;]+;\\s*)+/';
        if (preg_match($pattern, $contents, $matches, PREG_OFFSET_CAPTURE)) {
            $insertPos = $matches[0][1] + strlen($matches[0][0]);
            $newContents = substr($contents, 0, $insertPos) . "\n" . $route . "\n" . substr($contents, $insertPos);
            File::put($file, $newContents);
            $this->info('Webhook routes inserted after use statements in routes/api.php.');
        } else {
            // fallback: append if no use statements found
            File::append($file, "\n" . $route . "\n");
            $this->info('Webhook routes appended to routes/api.php.');
        }

        return self::SUCCESS;
    }
}
