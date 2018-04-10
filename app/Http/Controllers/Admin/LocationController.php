<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeoCity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class LocationController extends AdminController
{
    protected $city;

    public function __construct(GeoCity $city)
    {
        parent::__construct();

        $this->city = $city;
        $this->template = config('settings.theme') . '.admin.locations';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }
        $this->title = 'Управление локацией';

        $this->header = view(config('settings.theme') . '.admin.locations_header')->render();

        $this->content = view(config('settings.theme') . '.admin.locations_content')
            ->render();

        $this->footer = view(config('settings.theme').'.admin.locations_footer')->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
