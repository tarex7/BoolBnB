<?php

namespace App\Http\Requests;

use App\Rules\ValidSponsorship;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Ui\Presets\Vue;

class OrderRequest extends FormRequest
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
            'token'=>'required',
            'sponsorship'=>[
                'required',
                new ValidSponsorship()
        ],
        ];
    }
}
