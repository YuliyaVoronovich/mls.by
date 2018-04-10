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
            @if(isset($company->id))
                Редактирование компании
            @else
                Добавление компании
            @endif
        </h3>
        {!! Form::open(['url'=> (isset($company->id)) ? route('admin.companies.update', ['company'=>$company->id]) : route('admin.companies.store'), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3>Основная информация</h3>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Название<span
                                style="color: red">*</span></label>
                    <div class="col-xs-7">
                        {!! Form::text('title', isset($company->title) ? $company->title : old('title'), ['placeholder'=>'Введите название', 'class'=>'form-control', 'id'=>'title']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Название организации</label>
                    <div class="col-xs-7">
                        {!! Form::text('name_organization', isset($company->name_organization) ? $company->name_organization : old('name_organization'), ['placeholder'=>'Введите название организации', 'class'=>'form-control', 'id'=>'name_organization']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">ФИО директора</label>
                    <div class="col-xs-7">
                        {!! Form::text('fio_director', isset($company->fio_director) ? $company->fio_director : old('fio_director'), ['placeholder'=>'Введите фио директора компании', 'class'=>'form-control', 'id'=>'fio_director']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Телефон директора</label>
                    <div class="col-xs-7">
                        {!! Form::text('phone_director', isset($company->phone_director) ? $company->phone_director : old('phone_director'), ['placeholder'=>'Введите телефон директора компании', 'class'=>'form-control', 'id'=>'phone_director']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Лицензия</label>
                    <div class="col-xs-7">
                        {!! Form::text('license', isset($company->license) ? $company->license : old('license'), ['placeholder'=>'Введите лицензию компании', 'class'=>'form-control', 'id'=>'license']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Выдана</label>
                    <div class="col-xs-7">
                        {!! Form::text('license_issued', isset($company->license_issued) ? $company->license_issued : old('license_issued'), ['placeholder'=>'Введите кто выдал лицензию', 'class'=>'form-control', 'id'=>'license_issued']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">От</label>
                    <div class="col-xs-7">
                        {!! Form::date('license_from', isset($company->license_from) ? $company->license_from : old('license_from'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'license_from']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">До</label>
                    <div class="col-xs-7">
                        {!! Form::date('license_to', isset($company->license_to) ? $company->license_to : old('license_to'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'license_to']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Префикс</label>
                    <div class="col-xs-7">
                        {!! Form::text('prefix', isset($company->prefix) ? $company->prefix : old('prefix'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'prefix']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                 <h3>Дополнительная информация</h3>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">ID домовиты</label>
                    <div class="col-xs-7">
                        {!! Form::text('id_domovita', isset($company->companyInformation->id_domovita) ? $company->companyInformation->id_domovita : old('id_domovita'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'id_domovita']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Логин онлайнер</label>
                    <div class="col-xs-7">
                        {!! Form::text('login_onliner', isset($company->companyInformation->login_onliner) ? $company->companyInformation->login_onliner : old('login_onliner'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'login_onliner']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Пароль онлайнер</label>
                    <div class="col-xs-7">
                        {!! Form::text('pass_onliner', isset($company->companyInformation->pass_onliner) ? $company->companyInformation->pass_onliner : old('pass_onliner'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'pass_onliner']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Логин реалт</label>
                    <div class="col-xs-7">
                        {!! Form::text('login_realt', isset($company->companyInformation->login_realt) ? $company->companyInformation->login_realt : old('login_realt'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'login_realt']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Пароль реалт</label>
                    <div class="col-xs-7">
                        {!! Form::text('pass_realt', isset($company->companyInformation->pass_realt) ? $company->companyInformation->pass_realt : old('pass_realt'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'pass_realt']) !!}
                    </div>
                </div>
            </div>
        </div>
        @if(isset($modules))
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h3>Модули</h3>
                    @foreach($modules as $module)
                        <div class="checkbox">
                            <label for="{{$module->title}}">
                                @if (isset($company) && $company->hasModule($module->title))
                                    {!! Form::checkbox('module[]', $module->id, true) !!} {{$module->title}}
                                @else
                                    {!! Form::checkbox('module[]', $module->id) !!} {{$module->title}}
                                @endif

                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!isset($company->id))
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Сотрудник</h3>
                <div class="form-group">
                    <label for="name" class="col-xs-5 control-label text-left">Имя сотрудника</label>
                    <div class="col-xs-7">
                        {!! Form::text('name','', ['placeholder'=>'', 'class'=>'form-control', 'id'=>'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="login" class="col-xs-5 control-label text-left">Логин сотрудника</label>
                    <div class="col-xs-7">
                        {!! Form::text('login','', ['placeholder'=>'', 'class'=>'form-control', 'id'=>'login']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-xs-5 control-label text-left">Пароль сотрудника</label>
                    <div class="col-xs-7">
                        {!! Form::text('password','', ['placeholder'=>'', 'class'=>'form-control', 'id'=>'password']) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($company->id))

            {{ method_field('PUT') }}
        @endif

        {!! Form::button('Сохранить', ['class'=>'btn btn-lg btn-info', 'type'=>'submit']) !!}


        {!! Form::close() !!}
    </div>
</div>