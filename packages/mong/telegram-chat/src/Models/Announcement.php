<?php

namespace Mong\TelegramChat\Models;

use Illuminate\Database\Eloquent\Model;
use Mong\TelegramChat\Models\AnnouncementLog;

class Announcement extends Model
{
    protected $fillable = [
        'created_by',
        'title',
        'description',
        'telegram_user_ids',
        'sent_all',
        'status',
        'media_detail',
    ];

    protected $casts = [
        'telegram_user_ids' => 'array',
        'media_detail' => 'array',
        'sent_all' => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(AnnouncementLog::class);
    }
}

