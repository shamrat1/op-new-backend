<?php
namespace App\Http\Traits;

trait BetValueSetter {

    public function getBetValue($rate)
    {
        switch ($rate){
            case ($rate <= 1.30):
                return $rate;
            case ($rate >= 1.31 && $rate <= 1.79):
                return $this->addOrSubstract($rate,(rand(0, 5) / 100));
            case ($rate >= 1.80 && $rate <= 2.00):
                return $rate;
            case ($rate > 2.01):
                return $this->addOrSubstract($rate,(rand(0, 10) / 100));
            default:
                return $this->addOrSubstract($rate,(rand(0, 4) / 100));
        }
    }

    // val1 is bet value & val2 in random number
    private function addOrSubstract($val1,$val2)
    {
        $shouldAdd = (date('s') % 2) == 0 ? true : false;
        return $shouldAdd ? $val1 + $val2 : $val1 - $val2;
    }


}
?>