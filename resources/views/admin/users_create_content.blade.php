<div class="content">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <h3 style="margin-bottom: 40px">
            @if(isset($user->id))
                Редактирование сотрудника
            @else
                Добавление сотрудника
            @endif
        </h3>
        {!! Form::open(['url'=> (isset($user->id)) ? route('admin.users.update', ['user'=>$user->id]) : route('admin.users.store'), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Сотрудник</h3>
                <div class="form-group">
                    <label for="login" class="col-xs-5 control-label text-left">Логин</label>
                    <div class="col-xs-7">
                        {!! Form::text('login', isset($user->login) ? $user->login: old('login'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'login']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-xs-5 control-label text-left">Пароль</label>
                    <div class="col-xs-7">
                        {!! Form::text('password', isset($user->password_first) ? $user->password_first: old('password'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'password']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-xs-5 control-label text-left">Имя</label>
                    <div class="col-xs-7">
                        {!! Form::text('name', isset($user->userInformation->name) ? $user->userInformation->name : old('name'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="surname" class="col-xs-5 control-label text-left">Фамилия</label>
                    <div class="col-xs-7">
                        {!! Form::text('surname', isset($user->userInformation->surname) ? $user->userInformation->surname : old('surname'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'surname']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="patronymic" class="col-xs-5 control-label text-left">Отчество</label>
                    <div class="col-xs-7">
                        {!! Form::text('patronymic', isset($user->userInformation->patronymic) ? $user->userInformation->patronymic : old('patronymic'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'patronymic']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone1" class="col-xs-5 control-label text-left">Телефон1</label>
                    <div class="col-xs-7">
                        {!! Form::text('phone1', isset($user->userInformation->phone1) ? $user->userInformation->phone1 : old('phone1'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'phone1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone2" class="col-xs-5 control-label text-left">Телефон2</label>
                    <div class="col-xs-7">
                        {!! Form::text('phone2', isset($user->userInformation->phone2) ? $user->userInformation->phone2 : old('phone2'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'phone2']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="passport" class="col-xs-5 control-label text-left">Паспортные данные</label>
                    <div class="col-xs-7">
                        {!! Form::text('passport', isset($user->userInformation->passport) ? $user->userInformation->passport : old('passport'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'passport']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_of_birth" class="col-xs-5 control-label text-left">Дата рождения</label>
                    <div class="col-xs-7">
                        {!! Form::date('date_of_birth', isset($user->userInformation->date_of_birth) ? $user->userInformation->date_of_birth : old('date_of_birth'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'date_of_birth']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="company_id" class="col-xs-5 control-label text-left">Компания</label>
                    <div class="col-xs-7">
                        {!! Form::select('company_id', $companies, (isset($user->company_id) && $user->company_id) ? $user->company_id : null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="manager_id" class="col-xs-5 control-label text-left">Менеджер</label>
                    <div class="col-xs-7">
                        {!! Form::select('manager_id', $users, (isset($user->manager_id) && $user->manager_id) ? $user->manager_id : null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-xs-5 control-label text-left">Фото</label>
                    <div class="col-xs-7">
                        фото
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-7 col-xs-offset-5">
                        <div class="checkbox">
                            <label for="ban">
                                {!! Form::checkbox('ban', '', (isset($user->ban) && $user->ban) ? true : '') !!}
                                Разбанить
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="role_id" class="col-xs-5 control-label text-left">Право</label>
                    <div class="col-xs-7">
                        {!! Form::select('role_id', $roles, (isset($user->role_id) && $user->role_id) ? $user->role_id : null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        @if(count($permissions)>0)
            <h3>Специальные права</h3>
            @foreach($permissions as $item)
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-4 col-sm-4">
                        <b>{{$item->title}}</b>
                    </div>
                    @if(isset($item->permissions))
                        <div class="col-md-9 col-sm-9">
                            @foreach($item->permissions as $permission)
                                <div class="col-md-8 col-sm-8">
                                    {{ $permission->title }}
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    @if (isset($user) && $user->hasUserPermission($permission->title, $permission->category_id)===1)
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', 1, true) !!} Да
                                        </label>
                                    @else
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', 1) !!} Да
                                        </label>
                                    @endif
                                    @if (isset($user) && $user->hasUserPermission($permission->title, $permission->category_id)===0)
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', 0, true) !!} Нет
                                        </label>
                                    @else
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', 0) !!} Нет
                                        </label>
                                    @endif
                                    @if (isset($user) && $user->hasUserPermission($permission->title, $permission->category_id)===2)
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', false, true) !!}
                                            Группа
                                        </label>
                                    @else
                                        <label class="radio-inline">
                                            {!! Form::radio('userPermissions['.$permission->id.']', false) !!} Группа
                                        </label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endif

        @if(isset($user->id))
            {{ method_field('PUT') }}
        @endif

        {!! Form::button('Сохранить', ['class'=>'btn btn-lg btn-info', 'type'=>'submit']) !!}

        {!! Form::close() !!}
    </div>
</div>