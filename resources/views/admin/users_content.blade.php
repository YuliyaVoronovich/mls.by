@if ($users)
    @foreach($users as $user)
        <tr>
            <td class="align-left">{!! Html::link(route('admin.users.edit',['user'=>$user->id]), isset($user->userInformation->name)? $user->userInformation->name : '') !!}</td>
            <td>
                {{ isset($user->userInformation->surname)? $user->userInformation->surname : '' }}
            </td>
            <td>{{ isset($user->userInformation->patronymic)? $user->userInformation->patronymic : '' }}</td>
            <td width="150px">
                {!! Form::open(['url'=>route('admin.users.ban',['user'=>$user->id]), 'method'=>'post']) !!}
                {!! Form::button('Забанить', ['class'=>'btn btn-md btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
            <td width="150px">
                {!! Form::open(['url'=>route('admin.users.destroy',['user'=>$user->id]), 'method'=>'post']) !!}
                {{ method_field('DELETE') }}
                {!! Form::button('Удалить', ['class'=>'btn btn-md btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>

    @endforeach
    {{--@for($i=0;$i<100;$i++)
        <tr>
            <td>{{$i}}</td>
        </tr>
    @endfor--}}
@endif
<tr id="scroll"></tr>