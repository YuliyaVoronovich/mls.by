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

<tbody>
@if ($companies)
    @foreach($companies as $company)
        <tr>
            <td class="align-left">{!! Html::link(route('admin.companies.edit',['company'=>$company->id]), $company->title, ['alt'=>$company->title]) !!}</td>
            <td>{{$company->fio_director}}</td>
            <td>{{$company->phone_director}}</td>
            <td width="150px">
                {!! Form::open(['url'=>route('admin.companies.destroy',['company'=>$company->id]), 'method'=>'post']) !!}
                {{ method_field('DELETE') }}
                {!! Form::button('Заблокировать', ['class'=>'btn btn-md btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
@endif
</tbody>
</table>
</div>

{!! Form::open(['url'=>route('admin.companies.create'), 'method'=>'get']) !!}
{!! Form::button('Добавить компанию', ['class'=>'btn btn-lg btn-success', 'type'=>'submit']) !!}
{!! Form::close() !!}

