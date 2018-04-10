<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Menu;
use Gate;

class AdminController extends Controller
{
    protected $user;

    protected $template;

    protected $header = FALSE;

    protected $content = FALSE;

    protected $footer = FALSE;

    protected $title;

    protected $vars;

    public function __construct()
    {

    }

    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();
        $navigation = view(config('settings.theme').'.admin.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        $this->vars = array_add($this->vars, 'header', $this->header);

        if ($this->content){
            $this->vars = array_add($this->vars, 'content', $this->content);
        }
        $this->vars = array_add($this->vars, 'footer', $this->footer);

        return view($this->template)->with($this->vars);

    }

    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu){

          $menu->add('Компании', array('route'=>'admin.companies.index'));
          $menu->add('Сотрудники', array('route'=>'admin.users.index'));
            $menu->get('sotrudniki')->add('Архив', array('route'=>'admin.users_arch.index'));
          $menu->add('Привилегии', array('route'=>'admin.roles.index'));
          $menu->add('Модули', array('route'=>'admin.modules.index'));
          $menu->add('Расположение', array('route'=>'admin.locations.index'));

        });


    }
}
