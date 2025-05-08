<?php

namespace Mong\TelegramChat\Controllers\Admin;

use Illuminate\Routing\Controller;

/**
 * Class TelegramAnnouncementController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TelegramAnnouncementController extends Controller
{
    public function index()
    {
        return view('telegram-chat::admin.telegram_announcement', [
            'title' => 'Telegram Announcement',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'TelegramAnnouncement' => false,
            ],
            'page' => 'resources/views/admin/telegram_announcement.blade.php',
            'controller' => 'Mong/Controllers/Admin/TelegramAnnouncementController.php',
        ]);
    }
}
