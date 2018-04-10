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
            @if(isset($module->id))
                Редактирование компании
            @else
                Добавление компании
            @endif
        </h3>
        {!! Form::open(['url'=> (isset($module->id)) ? route('admin.modules.update', ['module'=>$module->id]) : route('admin.modules.store'), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label for="region" class="col-xs-5 control-label text-left">Название модуля</label>
                    <div class="col-xs-7">
                        {!! Form::text('title', isset($module->title) ? $module->title : old('title'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'title']) !!}
                    </div>
                </div>
            </div>
        </div>
        @if(isset($module->id))
            {{ method_field('PUT') }}
        @endif

        {!! Form::button('Сохранить', ['class'=>'btn btn-lg btn-info', 'type'=>'submit']) !!}

        {!! Form::close() !!}
    </div>
</div>