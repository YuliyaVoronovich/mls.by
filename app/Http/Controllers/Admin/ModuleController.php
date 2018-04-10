<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Gate;
use App\Http\Requests\ModuleRequest;

class ModuleController extends AdminController
{
    protected $module;

    public function __construct(Module $module)
    {
        parent::__construct();
        $this->module = $module;

        $this->template = config('settings.theme') . '.admin.modules';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }

        $this->title = 'Менеджер модулей';

        $this->content = view(config('settings.theme') . '.admin.modules_content')
            ->with(['modules' => $this->module->get()])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }

        $this->title = 'Добавить новый модуль';
        $this->content = view(config('settings.theme') . '.admin.modules_create_content')->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        $result = $this->module->createModule($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.modules.index')->with($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }

        $this->title = 'Редактирование модуля - ' . $module->title;

        $this->content = view(config('settings.theme') . '.admin.modules_create_content')
            ->with(['module' => $module])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $result = $this->module->updateModule($request, $module);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.modules.index')->with($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $result = $this->module->deleteModule($module);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.modules.index')->with($result);
        }
    }
}
