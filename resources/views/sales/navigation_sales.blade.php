@if ($menu)
    {{-- {!! $menu->asUl(['class'=>'nav nav-tabs']) !!}--}}
    <div class="pull-left">
        <ul class="nav nav-pills">
            @include(config('settings.theme').'.customMenuItems', ['items'=>$menu->roots()])
        </ul>
    </div>
    <div class="pull-right" style="position: relative;display: block;padding: 10px 15px;">
        <span style="color: #0000F0">Печать</span>

        @include(config('settings.theme').'.level')
    </div>

@endif

