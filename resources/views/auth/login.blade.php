@extends('layouts.admin')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3">
                <form class="form" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Логин</label>

                        <div class="col-md-6">
                            <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Пароль</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-8">
                            <button type="submit" class="btn btn-primary">
                                Войти
                            </button>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

