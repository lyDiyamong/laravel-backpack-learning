<?php

namespace Mong\TelegramChat\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Mong\TelegramChat\Models\AnnouncementLog;
use Mong\TelegramChat\Models\TelegramMessage;

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
        return $this->hasMany(TelegramMessage::class, 'chat_id', 'id');
    }

    public function lastMessage()
    {
        return $this->hasOne(TelegramMessage::class, 'chat_id', 'id')->latest();
    }

    public function announcementLogs()
    {
        return $this->hasMany(AnnouncementLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
