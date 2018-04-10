<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionCategory;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class UserArchController extends AdminController
{
    protected $user;
    protected $company;
    protected $role;
    protected $permission;
    protected $category;
    protected $user_service;

    public function __construct(User $user, Company $company, Role $role, Permission $permission, PermissionCategory $category, UserService $user_service)
    {
        parent::__construct();
        $this->user = $user;
        $this->company = $company;
        $this->role = $role;
        $this->permission = $permission;
        $this->category = $category;
        $this->user_service = $user_service;

        $this->template = config('settings.theme') . '.admin.users';
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

        $this->title = 'Менеджер сотрудников';
        $companies_array = $this->user_service->companiesToArray($this->company->get());

        $this->header = view(config('settings.theme') . '.admin.users_header')->with(['companies' => $companies_array])->render();

        $this->content = view(config('settings.theme') . '.admin.users_content')
            ->with(['users' => $this->user->getUserDelete()])
            ->render();

        $this->footer = view(config('settings.theme') . '.admin.users_footer')->render();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function display(Request $request)
    {
        $index = $request->index;
        $request->request->add(['delete_user'=>'1']);

        $users = $this->user->getSearchUser($request, $index);

        return view(config('settings.theme') . '.admin.users_content')->with(['users' => $users]);
    }
}
