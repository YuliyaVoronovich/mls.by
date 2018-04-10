{{--<script>
    $(document).ready(function ($) {
        $('.delete').on('click', function (e) {
                $('#delete').submit();
            }
        );
    });
</script>--}}

@if ($sales)
    @foreach($sales as $sale)
        <tr>
            <td class="align-left">
                <a href="{{ route('sales.edit',['sale'=>$sale->id]) }}" target="_self">
                    <img src="{{ asset(config('settings.theme')) }}images/edit.jpg" style="cursor:pointer"
                         alt="Редактироввать" title="Редактироввать">
                </a>
            </td>
            <td class="align-left">
                {!! Form::open(['url'=>route('sales.destroy',['sale'=>$sale->id]), 'method'=>'post']) !!}
                <input type="image" src="{{ asset(config('settings.theme')) }}images/delete.jpg"/>
                {{ method_field('DELETE') }}
                {!! Form::close() !!}
            </td>
            <td>{{$sale->price}}</td>
            <td>
                @if (isset($sale->location))
                    {{$sale->location->city->title}}<br>

                    @if ($sale->location->district)
                        {{$sale->location->district->title}}<br>
                    @endif
                    @if ($sale->location->microdistrict)
                        ({{$sale->location->microdistrict->title}})<br>
                    @endif
                    @if ($sale->location->street)
                        {{$sale->location->street->title}}, {{$sale->location->house}}/ {{$sale->location->housing}}
                    @endif
                @endif
            </td>
            <td>{{( isset($sale->location->type_house) && array_has($labels,$sale->location->type_house)) ? $labels[$sale->location->type_house] : ''}}</td>
            <td>{{$sale->storey}}</td>
            <td> {{(isset($sale->location)) ? $sale->location->year .'-'. $sale->location->year_repair : ''}}</td>
            <td>{{$sale->room}}/{{$sale->area}}</td>
            <td>{{$sale->comment}}</td>
            <td>
                {{ (isset($sale->user->userInformation)) ? $sale->user->userInformation->surname : ''}}
                {{ (isset($sale->user->userInformation)) ? $sale->user->userInformation->name : ''}}
            </td>
            <td>{{$sale->created_at}}</td>

        </tr>
    @endforeach
@endif
<tr id="scroll"></tr>
