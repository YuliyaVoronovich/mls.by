@foreach($items as $item)
    <li class="{{($item->hasChildren()) ? "dropdown" : '' }}">
        <a href="{{ $item->url() }}" {{($item->hasChildren()) ? "class=dropdown-toggle  data-toggle=dropdownnoclick" : '' }}>{{ $item->title }}
            @if ($item->hasChildren())
                <b class="caret"></b>
            @endif
        </a>
        @if($item->hasChildren())
            <ul class="dropdown-menu" role="menu">
                @include(config('settings.theme').'.admin.customMenuItems', ['items'=>$item->children()])
            </ul>
        @endif
    </li>
@endforeach