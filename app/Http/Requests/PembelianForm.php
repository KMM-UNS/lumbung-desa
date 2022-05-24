<?php

namespace App\Http\Requests;

use App\Constants\RequestRuleConstant;
use Illuminate\Foundation\Http\FormRequest;

class PembelianForm extends FormRequest
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

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return back()->withInput()->withToastError($validator->messages()->all()[0]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return RequestRuleConstant::pembelianTable();
    }
}
