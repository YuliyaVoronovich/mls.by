<style>
    /*.dropdown:hover > .dropdown-menu {
        display: block;
        margin: 0;
    }*/
    .dropdown-menu{
        position: relative;
    }
</style>
<div style="background: #f1eae9;  height: 100%;position: absolute; min-width: 160px">
@if ($menu)
    <div class="">
        <ul class="nav nav-pills nav-stacked">
            @include(config('settings.theme').'.customMenuItems', ['items'=>$menu->roots()])
        </ul>
    </div>
@endif
</div>
