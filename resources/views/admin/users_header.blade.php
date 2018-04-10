@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<div class="container" style="bottom: 0;position: fixed; width: 100%">
    <div class="row" style=" background: #ccc; padding: 5px">
        <div class="col-md-6 col-sm-6">
            {!! Form::open(['url'=> (last(request()->segments()) == 'users') ?  route('admin.users.display') : route('admin.users_arch.display') , 'method'=>'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-inline', 'id'=>'user_search_form']) !!}

            <div class="form-group">
                {{ Form::label('company_id', 'Компания', ['class' => 'col-xs-3 control-label text-left"']) }}
                <div class="col-xs-5">
                    {!! Form::select('company', $companies, (isset($user->company_id) && $user->company_id) ? $user->company_id : null, ['class'=>'form-control search']) !!}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('phone', 'Телефон', ['class' => 'col-xs-3 control-label text-left"']) }}
                <div class="col-xs-8">
                    {!! Form::text('phone', null, ['placeholder'=>'', 'class'=>'form-control search', 'id'=>'phone']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped tableSticky">
        <thead>
        <tr style="background:#cccccc">
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>