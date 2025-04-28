<?php

namespace Mong\TelegramChat\Models;

use Illuminate\Database\Eloquent\Model;
use Mong\TelegramChat\Models\Announcement;
use Mong\TelegramChat\Models\TelegramUser;

class AnnouncementLog extends Model
{
    protected $fillable = [
        'announcement_id',
        'telegram_user_id',
        'status',
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function telegramUser()
    {
        return $this->belongsTo(TelegramUser::class);
    }
}

