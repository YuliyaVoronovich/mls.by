<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sale;
use App\Services\SalesService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Gate;
use Auth;
use Menu;

class SaleController extends IndexController
{
    protected $user;
    protected $sale;
    protected $service;
    protected $user_service;

    public function __construct(User $user, Sale $sale, SalesService $service, UserService $user_service)
    {
        parent::__construct();

        $this->user = $user;
        $this->sale = $sale;
        $this->service = $service;
        $this->user_service = $user_service;

        $this->template = config('settings.theme') . '.sales.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('ACCESS_OBJECTS')) {
            abort(403);
        }

        $this->title = 'Продажа объектов';
        $this->bar = TRUE;

        $menu = $this->getMenu();
        $this->navigation_top = view(config('settings.theme') . '.sales.navigation_sales')->with('menu', $menu)->render();

        $this->header = view(config('settings.theme') . '.sales.sale_header')->render();

        $user_id = $this->user_service->getIdOnLevel();
        $sales = $this->sale->getAllSale($user_id);

        $this->content = view(config('settings.theme') . '.sales.sale_content')
            ->with([
                'sales' => $sales
            ])
            ->render();

        $this->footer = view(config('settings.theme') . '.sales.sale_footer')->render();

        return $this->renderOutput();
    }

    protected function getMenu()
    {
        return Menu::make('salesMenu', function ($menu) {
            $menu->add('Добавить', array('route' => 'sales.create'));
            $menu->add('Удаленные', array('route' => 'sales.index'));
            $menu->add('Архив', array('route' => 'sales.index'));
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create', new Sale)) {
            abort(403);
        }
        $this->title = 'Добавить новый объект';

        $this->content = view(config('settings.theme') . '.sales.sale_create_content')
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {

        $res = $this->service->createSale($request);

        $result = $this->sale->createSale($res);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('sales.index')->with($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        if (Gate::denies('show', new Sale)) {
            abort(403);
        }

        $this->title = 'Показ объекта';

        $this->content = view(config('settings.theme') . '.sales.sale_show_content')
            ->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        if (Gate::denies('edit', $sale)) {
            abort(403);
        }
        $this->title = 'Редактирование объекта';

        $this->content = view(config('settings.theme') . '.sales.sale_create_content')
            ->with([
                'sale' => $this->sale->getOne($sale->id),
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        dd($request);
        $result = $this->sale->updateSale($request, $sale);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('sales.index')->with($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {

        if (Gate::denies('delete', $sale)) {
            abort(403);
        }
        $result = $this->sale->deleteSale($sale);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('sales.index')->with($result);
        }
    }

    public function display(Request $request)
    {
        $index = $request->index;
        // $request->request->add(['delete_at' => '0']);
        $user_id = $this->user_service->getIdOnLevel();
        $sales = $this->sale->getAllSale($user_id, $index, $request);

        return view(config('settings.theme') . '.sales.sale_content')->with(['sales' => $sales]);

    }
}
