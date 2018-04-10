<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Menu;

class IndexController extends Controller
{
    protected $user;

    protected $template;

    protected $navigation_top = FALSE;

    protected $header = FALSE;

    protected $content = FALSE;

    protected $footer = FALSE;

    protected $title;

    protected $vars;

    protected $bar = FALSE;

    public function __construct()
    {

    }

    protected function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $this->vars = array_add($this->vars, 'bar', $this->bar);

        $this->vars = array_add($this->vars, 'navigation_top', $this->navigation_top);

        $menu = $this->getMenu();
        $navigation = view(config('settings.theme') . '.navigation_left')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation_left', $navigation);

        $this->vars = array_add($this->vars, 'header', $this->header);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }
        $this->vars = array_add($this->vars, 'footer', $this->footer);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('general', function ($menu) {

            $menu->add('Объекты', array('route' => 'sales.index'));
                $menu->get('obekty')->add('Продажа', array('route' => 'sales.index'));
                $menu->get('obekty')->add('Загород', array('route' => 'sales.index'));
            $menu->add('Клиенты', array('route' => 'sales.index'));
                $menu->get('klienty')->add('Продажа', array('route' => 'sales.create'));
                $menu->get('klienty')->add('Загород', array('route' => 'sales.create'));
        });


    }
}
