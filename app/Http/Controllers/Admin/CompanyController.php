<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class CompanyController extends AdminController
{
    protected $company;
    protected $module;

    public function __construct(Company $company, Module $module)
    {
        parent::__construct();

        $this->company = $company;
        $this->module = $module;
        $this->template = config('settings.theme') . '.admin.companies';

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
        $this->title = 'Управление компаниями';

       // $header = $this->getHeader();
        $this->header = view(config('settings.theme') . '.admin.companies_header')->render();

        $this->content = view(config('settings.theme') . '.admin.companies_content')
            ->with(['companies'=>$this->company->get()])
            ->render();

        $this->footer = view(config('settings.theme').'.admin.companies_footer')->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }

        $this->title = 'Добавить новую компанию';

        $this->content = view(config('settings.theme') . '.admin.companies_create_content')
            ->with(['modules'=>$this->module->get()])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $result = $this->company->createCompany($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.companies.index')->with($result);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if (Gate::denies('ACCESS_ADMIN')) {
            abort(403);
        }
        $this->title = 'Редактирование компании - ' . $company->title;

        $this->content = view(config('settings.theme') . '.admin.companies_create_content')
            ->with([
                'company' => $this->company->getOneCompany($company->id),
                'modules'=>$this->module->get()
            ])
            ->render();

        return $this->renderOutput();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $result = $this->company->updateCompany($request, $company);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.companies.index')->with($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $result = $this->company->deleteCompany($company);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        } else {
            return redirect()->route('admin.companies.index')->with($result);
        }
    }
}
