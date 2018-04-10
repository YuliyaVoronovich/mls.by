@extends(config('settings.theme').'.layouts.mls')

@section('navigation_top')
    {!! $navigation_top !!}
@endsection

@section('navigation_left')
    {!! $navigation_left !!}
@endsection

@section('header')
    {!! $header!!}
@endsection

@section('content')
    {!! $content!!}
@endsection

@section('footer')
    {!! $footer!!}
@endsection