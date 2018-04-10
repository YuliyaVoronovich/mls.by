<?php
/**
 * Created by PhpStorm.
 * User: Юлия
 * Date: 29.03.2018
 * Time: 15:53
 */

namespace App\Http\ViewComposers;

use App\Services\LabelsService;
use Illuminate\View\View;


class LabelsComposer
{
    protected $label;

    public function __construct(LabelsService $label_service)
    {
        $this->label_service = $label_service;
    }

    public function compose(View $view)
    {
        $label = $this->label_service->labelsToArray();

        $view->with([
            'labels' => $label
        ]);

    }

}