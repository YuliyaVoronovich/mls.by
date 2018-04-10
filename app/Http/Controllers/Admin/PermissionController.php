<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Gate;


class PermissionController extends AdminController
{

    protected $permission;
    protected $role;
    protected $category;

    public function __construct(Permission $permission, Role $role, PermissionCategory $category)
    {
        parent::__construct();
        $this->permission = $permission;
        $this->role = $role;
        $this->category = $category;

        $this->template = config('settings.theme') . '.admin.permissions';
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

        $this->title = 'Менеджер прав пользователей';

        $this->header = view(config('settings.theme') . '.admin.permissions_header')->render();

        $this->content = view(config('settings.theme') . '.admin.permissions_content')
            ->with(['roles' => $this->role->get()])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = $role->with('permissions')
            ->where('id', "=", $role->id)
            ->get()
            ->first();

        $array_checkbox_inline = explode(',',config('constants.array_category_checkbox'));

        $this->content = view(config('settings.theme') . '.admin.permissions_edit_content')
            ->with([
                'role' => $role,
                'array_checkbox_inline' => $array_checkbox_inline,
                'permissions' => $this->category->with('permissions')->get()
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $result = $this->permission->changePermissions($request, $role);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('admin.roles.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
