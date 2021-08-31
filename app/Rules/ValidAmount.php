<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    protected $upperLimit;
    protected $lowerLimit;

    public function __construct($down,$up)
    {
        $this->upperLimit = $up;
        $this->lowerLimit = $down;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        return $this->upperLimit > 25000 ? $value >= $this->lowerLimit && $value <= 25000 : $value >= $this->lowerLimit && $value <= $this->upperLimit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->upperLimit > 25000 ? "The :attribute must be greater then $this->lowerLimit & less then 25000" : "The :attribute must be greater then $this->lowerLimit & less then $this->upperLimit.";
    }
}
