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
<!-- Поиск -->
<div class="container" style="bottom: 0;position: fixed; width: 100%">
    <div class="row" style=" background: #ccc; padding: 5px">
        <div class="col-md-6 col-sm-6">
            {!! Form::open(['url'=> (last(request()->segments()) == 'sales') ?  route('sales.display') : '' , 'method'=>'POST', 'enctype'=>'multipart/form-data', 'class'=>'form-inline', 'id'=>'user_search_form']) !!}

            <div class="form-group">
                {{ Form::label('price', 'Цена', ['class' => 'col-xs-3 control-label text-left"']) }}
                <div class="col-xs-8">
                    {!! Form::text('price', null, ['placeholder'=>'', 'class'=>'form-control search', 'id'=>'price']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr style="background:#cccccc">
            <th></th>
            <th></th>
            <th>$|m<sup>2</sup></th>
            <th>местрорасположение</th>
            <th>тип</th>
            <th>этаж</th>
            <th>г-г.к.</th>
            <th>параметры</th>
            <th>примечание</th>
            <th>сотрудник</th>
            <th>даты</th>
        </tr>
        </thead>
        <tbody>