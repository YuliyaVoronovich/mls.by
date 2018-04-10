@extends(config('settings.theme').'.layouts.admin')

@section('navigation')
    {!! $navigation !!}
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