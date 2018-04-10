<style>
    .dropdown:hover > .dropdown-menu {
        display: block;
        margin: 0;
    }
</style>
@if ($menu)
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            @include(config('settings.theme').'.admin.customMenuItems', ['items'=>$menu->roots()])
        </ul>
    </div>
@endif
