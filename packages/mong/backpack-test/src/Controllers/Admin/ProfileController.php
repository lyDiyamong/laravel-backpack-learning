<?php

namespace Mong\BackpackTest\Controllers\Admin;

use Illuminate\Routing\Controller;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProfileController extends Controller
{
    public function index()
    {
        return view('backpack-test::admin.profile', [
            'title' => 'Profile',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'Profile' => false,
            ],
            'page' => 'resources/views/admin/profile.blade.php',
            'controller' => 'app/Http/Controllers/Admin/ProfileController.php',
        ]);
    }
}
