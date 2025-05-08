<?php

declare(strict_types=1);

namespace Mong\TelegramChat\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class AddPusherToJS extends Command
{
    protected $signature = 'telegram-chat:add-pusher';
    protected $description = 'Add Pusher to JS';

    public function handle(): int
    {
        $jsCode = <<<JS

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
JS;

        $file = resource_path('js/app.js');

        if (!File::exists($file)) {
            $this->error('File not found: ' . $file);
            return self::FAILURE;
        }

        $contents = File::get($file);

        // Check if Echo initialization already exists
        if (str_contains($contents, "new Echo({")) {
            $this->info('Pusher/Echo initialization already exists in ' . $file);
            return self::SUCCESS;
        }

        // Append the JS code to the end of the file
        File::append($file, "\n" . $jsCode . "\n");
        $this->info('Pusher/Echo initialization added to ' . $file);

        return self::SUCCESS;
    }
}
