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
use App\Http\Requests\UserRequest;

class UserController extends AdminController
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
            ->with(['users' => $this->user->getUserNoDelete()])
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
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }
        $this->title = 'Добавить нового сотрудника';

        $companies_array = $this->user_service->companiesToArray($this->company->get());
        $users_array = $this->user_service->usersToArray($this->user->getUserNoDelete());
        $role_array = $this->user_service->rolesToArray($this->role->get());

        $this->content = view(config('settings.theme') . '.admin.users_create_content')
            ->with([
                'companies' => $companies_array,
                'users' => $users_array,
                'roles' => $role_array,
                'permissions' => $this->category->with('permissions')->get()
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data['userPermissions'] =  $this->user_service->rejectArrayNull($request->userPermissions);
        $data['userPermissions'] =  $this->user_service->reduceArray($data['userPermissions']);

        $request->request->add(['userPermissions'=>$data['userPermissions']]);

        $result = $this->user->createUser($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect('/admin/users')->with($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }
        $this->title = 'Редактирование сотрудника';


        $user = $this->user->getUserId($user->id);

        $companies_array = $this->user_service->companiesToArray($this->company->get());
        $users_array = $this->user_service->usersToArray($this->user->getUserNoDelete());
        $role_array = $this->user_service->rolesToArray($this->role->get());

        $this->content = view(config('settings.theme') . '.admin.users_create_content')
            ->with([
                'user' => $user,
                'companies' => $companies_array,
                'users' => $users_array,
                'roles' => $role_array,
                'permissions' => $this->category->with('permissions')->get()
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data['userPermissions'] =  $this->user_service->rejectArrayNull($request->userPermissions);
        $data['userPermissions'] =  $this->user_service->reduceArray($data['userPermissions']);

        $request->request->add(['userPermissions'=>$data['userPermissions']]);

        $result = $this->user->updateUser($request, $user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.users.index')->with($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $this->user->deleteUser($user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.users.index')->with($result);
        }

    }

    public function ban(User $user)
    {
        $result = $this->user->banUser($user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.users.index')->with($result);
        }
    }

    /**
     * Подгрузка и поиск
     *
     * @param Request $request
     * @return $this
     */

    public function display(Request $request)
    {
        $index = $request->index;
        $request->request->add(['delete_user'=>'0']);

        $users = $this->user->getSearchUser($request, $index);

        return view(config('settings.theme') . '.admin.users_content')->with(['users' => $users]);
    }
}
