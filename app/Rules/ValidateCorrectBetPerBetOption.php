<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateCorrectBetPerBetOption implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $isCorrectArray;
    public function __construct($arr)
    {
        $this->isCorrectArray = $arr;
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
        if(in_array("1",$this->isCorrectArray)){
            if ($this->countArrayValue($this->isCorrectArray, "1") == 1) {
                return true;
            }
        }else{
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Multiple correct bets are selected. Select only one correct bet.';
    }

    protected function countArrayValue($array, $valueToCompare){
        $count = 0;
        foreach ($array as $key => $value) {
            if ($value == $valueToCompare) {
                $count++;
            }
        }
        return $count;
    }
}
