<?php

namespace Mong\TelegramChat\Controllers\Admin;
use Illuminate\Routing\Controller;

/**
 * Class TelegramChatController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TelegramChatController extends Controller
{
    public function index()
    {
        return view('telegram-chat::admin.telegram_chat', [
            'title' => 'Telegram Chat',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'TelegramChat' => false,
            ],
            'page' => 'resources/views/admin/telegram_chat.blade.php',
            'controller' => 'Mong/TelegramChat/Controllers/Admin/TelegramChatController.php',
        ]);
    }
}
