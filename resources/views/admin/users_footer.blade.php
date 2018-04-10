</tbody>
</table>
</div>

{!! Form::open(['url'=>route('admin.users.create'), 'method'=>'get']) !!}
{!! Form::button('Добавить сотрудника', ['class'=>'btn btn-lg btn-success', 'type'=>'submit']) !!}
{!! Form::close() !!}