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

        @if (!$roles->isEmpty())
            @foreach($roles as $role)
               {{-- {{$role->users->first()->companies->title}}--}}
                <tr>
                    <td>{{ isset($role->users->first()->company) ? $role->users->first()->company->title : ''}}</td>
                    <td>{!! Html::link(route('admin.roles.edit',['role'=>$role->id]), $role->title, ['alt'=>$role->title]) !!}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
