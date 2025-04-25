<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.telegram_announcement', [
            'title' => 'Telegram Announcement',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'TelegramAnnouncement' => false,
            ],
            'page' => 'resources/views/admin/telegram_announcement.blade.php',
            'controller' => 'app/Http/Controllers/Admin/TelegramAnnouncementController.php',
        ]);
    }
}
