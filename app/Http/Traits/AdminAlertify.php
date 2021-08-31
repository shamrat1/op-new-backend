<?php
namespace App\Http\Traits;

trait AdminAlertify {


    public function showSuccessAlert($message){
        alertify()->success($message)->position('bottom right');
    }

    public function showErrorAlert($message)
    {
        alertify()->error($message)->position('bottom right');
    }
}
?>