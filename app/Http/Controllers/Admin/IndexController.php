<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Gate;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->template = config('settings.theme') . '.admin.index';

    }

    public function index()
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }
        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }


}
