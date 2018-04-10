<div id="content" class="content" style="margin-left: 30px">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Привилегии</h3>

            {!! Form::open(['url'=> route('admin.roles.update', ['role'=>$role->id]), 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

            @if(isset($role->id))
                {{ method_field('PUT') }}
            @endif
            @foreach($permissions as $item)
                <div class="col-md-2 col-sm-3">
                    <b>{{ $item->title}}</b>
                </div>
                @if(isset($item->permissions))
                    <div class="col-md-9 col-sm-9">
                        @foreach($item->permissions as $permission)

                            @if (in_array($permission->category_id, $array_checkbox_inline))
                                <label class="checkbox-inline" for="{{$permission->id}}">
                            @else
                                <label class="checkbox" for="{{$permission->id}}" style="font-weight: normal">
                            @endif
                                 @if (isset($role) && $role->hasPermission($permission->title, $permission->category_id))
                                    {!! Form::checkbox('permission[]', $permission->id, true) !!} {{$permission->title}}
                                 @else
                                    {!! Form::checkbox('permission[]', $permission->id) !!} {{$permission->title}}
                                 @endif
                                </label>
                        @endforeach
                    </div>
                @endif
            @endforeach

            <div class="col-md-2 col-sm-2">
                {!! Form::button('Обновить', ['class'=>'btn btn-lg btn-info', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>