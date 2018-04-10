<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:255',
            /* 'license_from'=>'date',
             'license_to'=>'date',
          /* 'name'=>'required|max:255',
             'login'=>'required|max:255',
             'password'=>'required|max:60',
             'id_domovita'=>'integer'*/
        ];
    }
}
