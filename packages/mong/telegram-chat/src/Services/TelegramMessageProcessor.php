<?php

namespace Mong\TelegramChat\Services;

use Mong\TelegramChat\Models\TelegramUser;
use Mong\TelegramChat\Models\TelegramMessage;
use Mong\TelegramChat\Contracts\FileServiceInterface;
use Mong\TelegramChat\Contracts\TelegramServiceInterface;
use Illuminate\Support\Facades\Log;

class TelegramMessageProcessor
{
    public function __construct(
        private TelegramUser $telegramUser,
        private TelegramMessage $telegramMessage,
        private FileServiceInterface $fileService,
        // private TelegramServiceInterface $telegramService
    ) {}

    public function process(array $messageData): ?TelegramMessage
    {
        $telegramUser = $this->getOrCreateUser($messageData['chat']);

        if (isset($messageData['text'])) {
            return $this->createTextMessage($telegramUser, $messageData['text']);
        }

        if (isset($messageData['document'])) {
            return $this->processDocument($telegramUser, $messageData['document'], $messageData['caption'] ?? null);
        }

        if (isset($messageData['photo'])) {
            return $this->processPhoto($telegramUser, $messageData['photo'], $messageData['caption'] ?? null);
        }

        if (isset($messageData['voice'])) {
            return $this->processAudio($telegramUser, $messageData['voice'], $messageData['caption'] ?? null);
        }

        if (isset($messageData['audio'])) {
            return $this->processAudio($telegramUser, $messageData['audio'], $messageData['caption'] ?? null);
        }

        return null;
    }

    protected function getOrCreateUser(array $chatData): TelegramUser
    {
        return $this->telegramUser->updateOrCreate(
            ['id' => $chatData['id']],
            [
                'user_id' => $chatData['id'],
                'first_name' => $chatData['first_name'] ?? '',
                'last_name' => $chatData['last_name'] ?? '',
                'username' => $chatData['username'] ?? '',
            ]
        );
    }

    protected function createTextMessage(TelegramUser $user, string $text): TelegramMessage
    {
        return $this->telegramMessage->create([
            'chat_id' => $user->id,
            'message_type' => 'text',
            'text' => $text,
            'direction' => 'in',
            'status' => 'received',
            'is_read' => false,
        ]);
    }

    protected function processDocument(TelegramUser $user, array $document, ?string $caption): TelegramMessage
    {
        return $this->telegramMessage->create([
            'chat_id' => $user->id,
            'message_type' => 'document',
            'text' => json_encode([
                'caption' => $caption,
                'file_id' => $document['file_id'],
                'mime_type' => $document['mime_type'],
                'file_name' => $document['file_name'],
            ]),
            'direction' => 'in',
            'status' => 'received',
            'is_read' => false,
        ]);
    }

    protected function processAudio(TelegramUser $user, array $audio, ?string $caption): TelegramMessage
    {
        return $this->telegramMessage->create([
            'chat_id' => $user->id,
            'message_type' => 'audio',
            'text' => json_encode([
                'caption' => $caption,
                'file_id' => $audio['file_id'],
                'mime_type' => $audio['mime_type'] ?? 'audio/ogg',
                'duration' => $audio['duration'] ?? null,
            ]),
            'direction' => 'in',
            'status' => 'received',
            'is_read' => false,
        ]);
    }

    protected function processPhoto(TelegramUser $user, array $photos, ?string $caption): TelegramMessage
    {
        $photo = end($photos);

        return $this->telegramMessage->create([
            'chat_id' => $user->id,
            'message_type' => 'photo',
            'text' => json_encode([
                'caption' => $caption,
                'file_id' => $photo['file_id'],
            ]),
            'direction' => 'in',
            'status' => 'received',
            'is_read' => false,
        ]);
    }
}
