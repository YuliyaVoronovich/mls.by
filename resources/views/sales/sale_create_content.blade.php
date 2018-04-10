<!-- Map -->
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="{{ asset(config('settings.theme')) }}css/Newstyles.css"/>

<!-- Nav tabs -->
<nav class="navbar-default navbar-fixed-top hidden-xs">
    <div class="topMenu container">
        <div class="btn-group buttonGroup" style="float: left;">
            <a href="{{ route('sales.index') }}" role="button" class="btn btn-primary" style="font-size: 16px">
                <span class="icon-arrow-circle-o-left" data-toggle="tooltip" data-placement="righ"><span
                            style="padding: 3px">Назад</span></span>
            </a>
        </div>
        <div class="text-center">
            <div class="btn-group buttonGroup">
                <a href="#area" aria-controls="area" role="button" class="btn btn-default">Место</a>
                <a href="#characteristics" aria-controls="characteristics" role="button" class="btn btn-default">Характеристики</a>
                <a href="#dopCharacteristics" aria-controls="dopCharacteristics" role="button"
                   class="btn btn-default">Доп
                    хар-ки</a>
                <a href="#deal" aria-controls="deal" role="button" class="btn btn-default">Условия сделки</a>
                <a href="#advert" aria-controls="advert" role="button" class="btn btn-default">Объявление</a>
                <a href="#contact" aria-controls="contact" role="button" class="btn btn-default">Контакты</a>
                <a href="#photos" aria-controls="photos" role="button" class="btn btn-default">Фото</a>
            </div>
        </div>
    </div>
</nav>

@if (isset($sale->id))
    @if ($sale->location)
        @set($region, $sale->location->city->districtCountry->region->id)
        @set($city, $sale->location->city->title)
        @if ($sale->location->district)
            @set($district, $sale->location->district->title)
        @endif
        @if ($sale->location->microdistrict)
            @set($microdistrict, $sale->location->microdistrict->title)
        @endif
        @if ($sale->location->metro)
            @set($sale_metro, $sale->location->metro->id)
        @endif
    @endif
@endif


<div class="content">
    <div class="container myForm">
        {!! Form::open(['url'=> (isset($sale->id)) ? route('sales.update', ['sale'=>$sale->id]) : route('sales.store'), 'method'=>'POST', 'enctype'=>'multipart/form-data','role'=>"form",'class'=>"form-horizontal"]) !!}

        <div id="area" class="mark">
            <a name="area"></a>
            <div class="row newRow">
                <div class="col-md-6 col-sm-6">
                    <h3>Месторасположение</h3>
                    <div class="form-group">
                        <label for="region"
                               class="col-xs-5 control-label text-left required">Область<span>*</span></label>
                        <div class="col-xs-7">
                            {!! Form::select('region', $regions, isset($region) ? $region : null, ['class'=>'form-control', 'id'=>'city']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-xs-5 control-label text-left required">Населенный
                            пункт<span>*</span></label>
                        <div class="col-xs-7">
                            {!! Form::text('city', isset($city) ? $city : 'Минск', ['placeholder'=>'', 'class'=>'form-control', 'id'=>'city']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="street"
                               class="col-xs-5 control-label text-left required">Улица<span>*</span></label>
                        <div class="col-xs-7">
                            {!! Form::text('street', isset($sale->location->street->title) ? $sale->location->street->title : old('street'), ['placeholder'=>'Улица', 'class'=>'form-control', 'id'=>'street']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="house" class="col-xs-5 control-label text-left required">Номер
                            дома<span>*</span></label>
                        <div class="col-xs-2">
                            {!! Form::text('house', isset($sale->location->house) ? $sale->location->house : old('house'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'house']) !!}
                        </div>
                        <label for="housing" class="col-xs-2 control-label text-left">Корпус</label>
                        <div class="col-xs-2">
                            {!! Form::text('housing', isset($sale->location->housing) ? $sale->location->housing : old('housing'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'housing']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district"
                               class="col-xs-5 control-label text-left required">Район<span>*</span></label>
                        <div class="col-xs-7">
                            {!! Form::text('district', isset($district) ? $district : old('district'), ['placeholder'=>'Район', 'class'=>'form-control', 'id'=>'district']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="microdistrict"
                               class="col-xs-5 control-label text-left required">Микрорайон<span>*</span></label>
                        <div class="col-xs-7">
                            {!! Form::text('microdistrict', isset($microdistrict) ? $microdistrict : old('microdistrict'), ['placeholder'=>'Микрорайон', 'class'=>'form-control', 'id'=>'microdistrict']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number_flat" class="col-xs-5 control-label text-left">Номер квартиры</label>
                        <div class="col-xs-2">
                            {!! Form::text('number_flat', isset($sale->number_flat) ? $sale->number_flat : old('number_flat'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'number_flat']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metro" class="col-xs-5 control-label text-left">Станция метро</label>
                        <div class="col-xs-7">
                            {!! Form::select('metro', $metro, isset($sale_metro) ? $sale_metro : null, ['class'=>'form-control', 'id'=>'metro']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="img img-responsive map" id="myMap" style="width:520px; height:340px"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="characteristics" class="mark">
            <a name="characteristics"></a>
            <div class="newRow">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h3>Характеристики объекта</h3>
                        <div class="titleSecond">Планировка квартиры</div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="room" class="col-xs-5 control-label text-left required">Кол-во
                                    комнат<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('room', isset($sale->room) ? $sale->room : old('room'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'room']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roomSeparate" class="col-xs-5 control-label text-left required">Из них
                                    раздельных<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('room_separate', isset($sale->room_separate) ? $sale->room_separate : old('room_separate'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'room_separate']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="areaGeneral" class="col-xs-5 control-label text-left required">S
                                    общая<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('area', isset($sale->area) ? $sale->area : old('area'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'area']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="areaLeave" class="col-xs-5 control-label text-left required">S
                                    жилая<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('area_leave', isset($sale->area_leave) ? $sale->area_leave : old('area_leave'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'area_leave']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="areaKitchen" class="col-xs-5 control-label text-left required">S
                                    кухни<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('area_kitchen', isset($sale->area_kitchen) ? $sale->area_kitchen : old('area_kitchen'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'area_kitchen']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wc" class="col-xs-5 control-label text-left">Санузел</label>
                                <div class="col-xs-6">
                                    {!! Form::select('wc', $wc, isset($sale->wc) ? $sale->wc : null, ['class'=>'form-control', 'id'=>'wc']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="roof" class="col-xs-5 control-label text-left">Высота потолка</label>
                                <div class="col-xs-6">
                                    {!! Form::text('roof', isset($sale->roof) ? $sale->roof : old('roof'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'roof']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="balcony" class="col-xs-5 control-label text-left">Балкон</label>
                                <div class="col-xs-6">
                                    {!! Form::select('balcony', $balconies, isset($sale->balcony) ? $sale->balcony : null, ['class'=>'form-control', 'id'=>'balcony']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="terrace" class="col-xs-5 control-label text-left">Терраса</label>
                                <div class="col-xs-6">
                                    {!! Form::select('terrace', $terraces, isset($sale->terrace) ? $sale->terrace : null, ['class'=>'form-control', 'id'=>'terrace']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level" class="col-xs-5 control-label text-left">Уровни</label>
                                <div class="col-xs-6">
                                    {!! Form::select('level', $levels, isset($sale->level) ? $sale->level : null, ['class'=>'form-control', 'id'=>'level']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <div class="checkbox">
                                        <label for="elite">
                                            {!! Form::checkbox('elite', '', ((isset($sale->elite) && $sale->elite)? true : '')) !!}
                                            Элитная квартира
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="titleSecond">Тип дома</div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="wall" class="col-xs-5 control-label text-left">Материал стен</label>
                                <div class="col-xs-6">
                                    {!! Form::select('wall', $walls, isset($sale->location->wall) ? $sale->location->wall : null, ['class'=>'form-control', 'id'=>'wall']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="typeHouse" class="col-xs-5 control-label text-left">Тип дома</label>
                                <div class="col-xs-6">
                                    {!! Form::select('type_house', $types, isset($sale->location->type_house) ? $sale->location->type_house : null, ['class'=>'form-control', 'id'=>'type_house']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year" class="col-xs-5 control-label text-left">Год постройки</label>
                                <div class="col-xs-6">
                                    {!! Form::text('year', isset($sale->location->year) ? $sale->location->year : old('year'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'year']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="yearRepair" class="col-xs-5 control-label text-left">Год
                                    капремонта</label>
                                <div class="col-xs-6">
                                    {!! Form::text('year_repair', isset($sale->location->year_repair) ? $sale->location->year_repair : old('year_repair'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'year_repair']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="storey"
                                       class="col-xs-5 control-label text-left required">Этаж<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('storey', isset($sale->storey) ? $sale->storey : old('storey'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'storey']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="storeys"
                                       class="col-xs-5 control-label text-left required">Этажность<span>*</span></label>
                                <div class="col-xs-6">
                                    {!! Form::text('storeys', isset($sale->storeys) ? $sale->storeys : old('storeys'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'storeys']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="dopCharacteristics" class="mark">
            <a name="dopCharacteristics"></a>
            <div class="newRow">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3>Дополнительная информация</h3>
                        <div class="form-group">
                            <label for="repair" class="col-xs-6 control-label text-left">Ремонт</label>
                            <div class="col-xs-6">
                                {!! Form::select('repair', $repairs, isset($sale->repair) ? $sale->repair : null, ['class'=>'form-control', 'id'=>'repair']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="floor" class="col-xs-6 control-label text-left">Тип пола</label>
                            <div class="col-xs-6">
                                {!! Form::select('floor', $floors, isset($sale->floor) ? $sale->floor : null, ['class'=>'form-control', 'id'=>'floor']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="furniture" class="col-xs-6 control-label text-left">Мебель</label>
                            <div class="col-xs-6">
                                {!! Form::select('furniture', $furnitures, isset($sale->furniture) ? $sale->furniture : null, ['class'=>'form-control', 'id'=>'furniture']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row hidden-xs myCheckbox">
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="phone">
                                    {!! Form::checkbox('phone', '', ((isset($sale->saleDopInformation->phone) && $sale->saleDopInformation->phone)? true : '')) !!}
                                    Телефон
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="internet">
                                    {!! Form::checkbox('internet', '', ((isset($sale->saleDopInformation->internet) && $sale->saleDopInformation->internet)? true : '')) !!}
                                    Интернет
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="tv">
                                    {!! Form::checkbox('tv', '', ((isset($sale->saleDopInformation->tv) && $sale->saleDopInformation->tv)? true : '')) !!}
                                    Спутниковое ТВ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="intercom">
                                    {!! Form::checkbox('intercom', '', ((isset($sale->saleDopInformation->intercom) && $sale->saleDopInformation->intercom)? true : '')) !!}
                                    Домофон
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="video_intercom">
                                    {!! Form::checkbox('video_intercom', '', ((isset($sale->saleDopInformation->video_intercom) && $sale->saleDopInformation->video_intercom)? true : '')) !!}
                                    Видеодомофон
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="cctv">
                                    {!! Form::checkbox('cctv', '', ((isset($sale->saleDopInformation->cctv) && $sale->saleDopInformation->cctv)? true : '')) !!}
                                    Видеонаблюдение
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="signaling">
                                    {!! Form::checkbox('signaling', '', ((isset($sale->saleDopInformation->signaling) && $sale->saleDopInformation->signaling)? true : '')) !!}
                                    Охранная сигнализация
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="concierge">
                                    {!! Form::checkbox('concierge', '', ((isset($sale->saleDopInformation->concierge) && $sale->saleDopInformation->concierge)? true : '')) !!}
                                    Консьерж
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="door">
                                    {!! Form::checkbox('door', '', ((isset($sale->saleDopInformation->door) && $sale->saleDopInformation->door)? true : '')) !!}
                                    Металлическая дверь
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="elevator">
                                    {!! Form::checkbox('elevator', '', ((isset($sale->saleDopInformation->elevator) && $sale->saleDopInformation->elevator)? true : '')) !!}
                                    Лифт
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="chute">
                                    {!! Form::checkbox('chute', '', ((isset($sale->saleDopInformation->chute) && $sale->saleDopInformation->chute)? true : '')) !!}
                                    Мусоропровод
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="single_enter">
                                    {!! Form::checkbox('single_enter', '', ((isset($sale->saleDopInformation->single_enter) && $sale->saleDopInformation->single_enter)? true : '')) !!}
                                    Отдельный вход
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="garage">
                                    {!! Form::checkbox('garage', '', ((isset($sale->saleDopInformation->garage) && $sale->saleDopInformation->garage)? true : '')) !!}
                                    Гараж
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="parking">
                                    {!! Form::checkbox('parking', '', ((isset($sale->saleDopInformation->parking) && $sale->saleDopInformation->parking)? true : '')) !!}
                                    Стоянка авто
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="protected_parking">
                                    {!! Form::checkbox('protected_parking', '', ((isset($sale->saleDopInformation->protected_parking) && $sale->saleDopInformation->protected_parking)? true : '')) !!}
                                    Охраняемая
                                    стоянка
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="conditioner">
                                    {!! Form::checkbox('conditioner', '', ((isset($sale->saleDopInformation->conditioner) && $sale->saleDopInformation->conditioner)? true : '')) !!}
                                    Кондиционер
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="sanitary">
                                    {!! Form::checkbox('sanitary', '', ((isset($sale->saleDopInformation->sanitary) && $sale->saleDopInformation->sanitary)? true : '')) !!}
                                    Сантехника
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="window">
                                    {!! Form::checkbox('window', '', ((isset($sale->saleDopInformation->window) && $sale->saleDopInformation->window)? true : '')) !!}
                                    Стеклопакеты
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="cupboard">
                                    {!! Form::checkbox('cupboard', '', ((isset($sale->saleDopInformation->cupboard) && $sale->saleDopInformation->cupboard)? true : '')) !!}
                                    Встроен. шкаф
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="appliances">
                                    {!! Form::checkbox('appliances', '', ((isset($sale->saleDopInformation->appliances) && $sale->saleDopInformation->appliances)? true : '')) !!}
                                    Бытовая техника
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="dishwasher">
                                    {!! Form::checkbox('dishwasher', '', ((isset($sale->saleDopInformation->dishwasher) && $sale->saleDopInformation->dishwasher)? true : '')) !!}
                                    Посудомоечная машина
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="washer">
                                    {!! Form::checkbox('washer', '', ((isset($sale->saleDopInformation->washer) && $sale->saleDopInformation->washer)? true : '')) !!}
                                    Стиральная машина
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="fridge">
                                    {!! Form::checkbox('fridge', '', ((isset($sale->saleDopInformation->fridge) && $sale->saleDopInformation->fridge)? true : '')) !!}
                                    Холодильник
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="fireplace">
                                    {!! Form::checkbox('fireplace', '', ((isset($sale->saleDopInformation->fireplace) && $sale->saleDopInformation->fireplace)? true : '')) !!}
                                    Камин
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="basement">
                                    {!! Form::checkbox('basement', '', ((isset($sale->saleDopInformation->basement) && $sale->saleDopInformation->basement)? true : '')) !!}
                                    Подвал/кладовая
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="pool">
                                    {!! Form::checkbox('pool', '', ((isset($sale->saleDopInformation->pool) && $sale->saleDopInformation->pool)? true : '')) !!}
                                    Бассейн
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="jacuzzi">
                                    {!! Form::checkbox('jacuzzi', '', ((isset($sale->saleDopInformation->jacuzzi) && $sale->saleDopInformation->jacuzzi)? true : '')) !!}
                                    Джакузи
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="water_meters">
                                    {!! Form::checkbox('water_meters', '', ((isset($sale->saleDopInformation->water_meters) && $sale->saleDopInformation->water_meters)? true : '')) !!}
                                    Счетчики воды
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-8 col-sm-8">
                        <div class="form-group">
                            <label for="communications" class="col-xs-5 control-label text-left">Характер инженерных
                                коммуникаций</label>
                            <div class="col-xs-6">
                                {!! Form::text('communications', isset($sale->communications) ? $sale->communications : old('communications'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'communications']) !!}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-8 col-sm-8">
                            <div class="form-group">
                                <label for="comment" class="col-xs-5 control-label text-left">Примечание</label>
                                <div class="col-xs-6">
                                    {!! Form::textarea('comment', isset($sale->comment) ? $sale->comment : old('comment'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'comment' , 'rows'=>'5']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="source" class="col-xs-3 control-label text-left">Источник</label>
                                <div class="col-xs-7">
                                    {!! Form::select('source', $sources, isset($sale->source) ? $sale->source : null, ['class'=>'form-control', 'id'=>'source']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div id="deal" class="mark">
            <a name="deal"></a>
            <div class="newRow">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h3>Условия сделки</h3>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="price"
                                       class="col-xs-5 control-label text-left required">Стоимость<span>*</span></label>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        {!! Form::text('price', isset($sale->price) ? $sale->price : old('price'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'price']) !!}
                                        <div class="input-group-addon">$</div>
                                    </div>
                                </div>
                            </div>
                          {{--  <div class="form-group">
                                <label for="currency" class="col-xs-5 control-label text-left">Валюта</label>
                                <div class="col-xs-6">
                                    <select id="currency" name="valuta" class="form-control" disabled>
                                        <option selected>USD</option>
                                        <option>EUR</option>
                                        <option>BYN</option>
                                    </select>
                                </div>
                            </div>--}}
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <div class="checkbox">
                                        <label for="auction">
                                            {!! Form::checkbox('auction', '', ((isset($sale->auction) && $sale->auction)? true : '')) !!}
                                            Торг
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="own" class="col-xs-5 control-label text-left">Собственность</label>
                                <div class="col-xs-6">
                                    {!! Form::select('own', $owns, isset($sale->own) ? $sale->own : null, ['class'=>'form-control', 'id'=>'own']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sale" class="col-xs-5 control-label text-left">Усл. продажи</label>
                                <div class="col-xs-6">
                                    {!! Form::select('sale', $sales, isset($sale->sale) ? $sale->sale : null, ['class'=>'form-control', 'id'=>'sale']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exchange" class="col-xs-5 control-label text-left">Вар. обмена</label>
                                <div class="col-xs-6">
                                    {!! Form::text('exchange', isset($sale->exchange) ? $sale->exchange : old('exchange'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'exchange']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <label for="credit">
                                            {!! Form::checkbox('credit', '', ((isset($sale->credit) && $sale->credit)? true : '')) !!}
                                            С исп. кредита
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <label for="execution">
                                            {!! Form::checkbox('execution', '', ((isset($sale->execution) && $sale->execution)? true : '')) !!}
                                            С оформлением
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <label for="quickly">
                                            {!! Form::checkbox('quickly', '', ((isset($sale->quickly) && $sale->quickly)? true : '')) !!}
                                            Срочно
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? if (true) { ?>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="dogovor" class="col-xs-5 control-label text-left">Договор</label>
                                <div class="col-xs-7">
                                    {!! Form::text('dogovor', isset($sale->dogovor) ? $sale->dogovor : old('dogovor'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'dogovor']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dogovor_from" class="col-xs-5 control-label text-left">От</label>
                                <div class="col-xs-7">
                                    {!! Form::text('dogovor_from', isset($sale->dogovor_from) ? $sale->dogovor_from : old('dogovor_from'), ['placeholder'=>'', 'class'=>'form-control datepicker', 'id'=>'dogovor_from']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dogovor_to" class="col-xs-5 control-label text-left">До</label>
                                <div class="col-xs-7">
                                    {!! Form::text('dogovor_to', isset($sale->dogovor_to) ? $sale->dogovor_to : old('dogovor_to'), ['placeholder'=>'', 'class'=>'form-control datepicker', 'id'=>'dogovor_to']) !!}
                                </div>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                <label for="commission" class="col-xs-6 control-label text-left">Партнерская
                                    коммиссия</label>
                                <div class="col-xs-6">
                                    {!! Form::text('commission', isset($sale->commission) ? $sale->commission : old('commission'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'commission']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <select id="commission_prefix" name="commission_prefix" class="form-control">
                                        <option value="0"></option>
                                        <option value="bv">базовые величины</option>
                                        <option value="pr">процент</option>
                                        <option value="byn">белорусские рубли</option>
                                        <option value="usd">доллары США</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="advert" class="mark">
            <div class="row newRow">
                <div class="col-md-6 col-sm-6">
                    <a name="advert"></a>
                    <h3>Характеристики объявления</h3>
                    <div class="form-group">
                        <div class="col-xs-10">
                            <div class="checkbox">
                                <label for="send">
                                    {!! Form::checkbox('send', '', ((isset($sale->send) && $sale->send)? true : '')) !!}
                                    Отправить в рекламу
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-xs-5 control-label text-left">Заголовок</label>
                        <div class="col-xs-6">
                            {!! Form::text('title', isset($sale->title) ? $sale->title : old('commission'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'title']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-xs-5 control-label text-left">Рекламный текст</label>
                        <div class="col-xs-6">
                            {!! Form::textarea('text', isset($sale->text) ? $sale->text : old('text'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'text' , 'rows'=>'5']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <a name="contact"></a>
                    <h3>Контакты</h3>
                    <div class="form-group">
                        <label for="contPhone1" class="col-xs-5 control-label text-left">Телефон1</label>
                        <div class="col-xs-6">
                            {!! Form::text('cont_phone1', isset($sale->cont_phone1) ? $sale->cont_phone1 : old('cont_phone1'), ['placeholder'=>'', 'class'=>'form-control onlydigits', 'id'=>'cont_phone1']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cont_phone2" class="col-xs-5 control-label text-left">Телефон2</label>
                        <div class="col-xs-6">
                            {!! Form::text('cont_phone2', isset($sale->cont_phone2) ? $sale->cont_phone2 : old('cont_phone2'), ['placeholder'=>'', 'class'=>'form-control onlydigits', 'id'=>'cont_phone2']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fio" class="col-xs-5 control-label text-left">ФИО</label>
                        <div class="col-xs-6">
                            {!! Form::text('fio', isset($sale->fio) ? $sale->fio : old('fio'), ['placeholder'=>'', 'class'=>'form-control', 'id'=>'fio']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_id" class="col-xs-5 control-label text-left">Сотрудник</label>
                        <div class="col-xs-6">
                            {!! Form::select('user_id', $users, isset($sale->user_id) ? $sale->user_id : null, ['class'=>'form-control', 'id'=>'user_id']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="photos" class="mark">
            <div class="row newRow">
                <div class="col-md-12 col-sm-12">
                    <a name="photos"></a>
                    <h3>Фото</h3>
                    <input id="photo" name="photo" type="hidden" value=""/>

                </div>
            </div>
        </div>

        @if(isset($sale->id))
            {{ method_field('PUT') }}
        @endif

        <div class="form-group myButton">
            <div class="col-md-12 col-sm-12">
                {!! Form::button('Сохранить', ['class'=>'btn btn-lg btn-primary', 'type'=>'submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>