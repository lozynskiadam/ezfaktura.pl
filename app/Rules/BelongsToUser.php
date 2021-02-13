<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BelongsToUser implements Rule
{
    protected $model;

    public function __construct($model)
    {
        $this->model = new $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $object = $this->model->find($value);
        return $object ? $object->user_id === auth()->id() : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('This object not exists.');
    }

}