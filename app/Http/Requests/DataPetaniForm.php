<?php

namespace App\Http\Requests;

use App\Constants\RequestRuleConstant;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Arr;

class DataPetaniForm extends FormRequest
{

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('password', 'required|min:6|confirmed', function ($request) {
            return $request->password;
        });

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
        return RequestRuleConstant::adminTable();
    }
}
