<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxDecimalPlaces implements Rule
{
    private $decimal_places;

    public function __construct($decimal_places)
    {
        $this->decimal_places = $decimal_places;
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
        return strlen(substr(strrchr($value, "."), 1)) <= $this->decimal_places;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.max_decimal_places', ['places' => $this->decimal_places]);
    }

}