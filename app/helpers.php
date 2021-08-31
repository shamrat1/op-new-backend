<?php
if(!function_exists('active')){
    function active($path, $active = 'active menu-open'){
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
}