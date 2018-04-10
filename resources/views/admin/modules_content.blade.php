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
<div class="table-responsive">
    <table class="table table-bordered table-striped" style="width: 400px">
        <thead>
        <tr style="background:#cccccc">
            <th>Название</th>
            <th></th>
        </tr>
        </thead>
<tbody>
@if ($modules)
    @foreach($modules as $module)
        <tr>
            <td class="align-left">{!! Html::link(route('admin.modules.edit',['module'=>$module->id]), $module->title, ['alt'=>$module->title]) !!}</td>
            <td width="150px">
                {!! Form::open(['url'=>route('admin.modules.destroy',['module'=>$module->id]), 'method'=>'post']) !!}
                {{ method_field('DELETE') }}
                {!! Form::button('Удалить', ['class'=>'btn btn-md btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
@endif
</tbody>
</table>
</div>

{!! Form::open(['url'=>route('admin.modules.create'), 'method'=>'get']) !!}
{!! Form::button('Добавить модуль', ['class'=>'btn btn-lg btn-success', 'type'=>'submit']) !!}
{!! Form::close() !!}