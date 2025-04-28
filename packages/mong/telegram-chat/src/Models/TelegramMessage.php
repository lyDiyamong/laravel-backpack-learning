<?php

namespace Mong\TelegramChat\Models;

use Illuminate\Database\Eloquent\Model;
use Mong\TelegramChat\Models\TelegramUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'chat_id',
        'message_type',
        'text',          // could store raw text or JSON-encoded message
        'direction',
        'status',
        'is_read',
    ];

    protected $casts = [
        'text' => 'json', // for full Telegram-style content
        'is_read' => 'boolean',
    ];

    public function telegramUser()
    {
        return $this->belongsTo(TelegramUser::class, 'chat_id', 'user_id');
    }

    public function getMediaTypeAttribute()
    {
        return $this->text['photo'] ? 'photo'
            : ($this->text['video'] ? 'video'
                : ($this->text['document'] ? 'document'
                    : ($this->text['voice'] ? 'voice'
                        : 'text')));
    }

    public function getCaptionAttribute()
    {
        return $this->text['caption'] ?? null;
    }

    public function getMediaUrlAttribute()
    {
        // Assuming you store file_path or URL in Telegram-style keys
        return $this->text['photo']['file_path']
            ?? $this->text['video']['file_path']
            ?? $this->text['document']['file_path']
            ?? $this->text['voice']['file_path']
            ?? null;
    }
}
