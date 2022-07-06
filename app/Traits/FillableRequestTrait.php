<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait FillableRequestTrait
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
   * Configure the validator instance.
   *
   * @param  \Illuminate\Validation\Validator  $validator
   * @return void
   */
  public function withValidator($validator)
  {
    if ($validator->fails()) {
      return back()->withInput()->withToastError($validator->messages()->all()[0]);
    }
  }

  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
    $rules = collect($this->rules());
    $prefixes = collect($this->mapPrefix);
    $prefixes = $prefixes->map(function ($rule) {
      return explode('_', $rule);
    });
    $prefixes = array_unique(Arr::collapse($prefixes));

    $humanReadable = [];

    foreach ($rules->keys() as $rule) {
      $temp = (string) $rule;
      foreach ($prefixes as $prefix) {
        $removedPrefix = (string) Str::of($temp)->remove($prefix)->headline();
        $temp = $removedPrefix;
      }
      $humanReadable[$rule] = $temp;
    };
    return $humanReadable;
  }
}
