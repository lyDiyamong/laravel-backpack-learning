<?php

namespace Mong\TelegramChat\Models;

use App\Models\TelegramMessage;
use Illuminate\Database\Eloquent\Model;
use Mong\TelegramChat\Models\AnnouncementLog;

class TelegramUser extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'status',
        'profile_image',
        'username',
    ];

    public function messages()
    {
        return $this->hasMany(TelegramMessage::class, 'chat_id', 'user_id');
    }

    public function announcementLogs()
    {
        return $this->hasMany(AnnouncementLog::class);
    }
}
