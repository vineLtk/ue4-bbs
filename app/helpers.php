<?php

/**
 * 获取当前路由名称转换为CSS类名
 */
function route_class(){
    return str_replace('.', '-', Route::currentRouteName());
}

function default_img($str = 'ue4小论坛', $size = '100'){
    $hash = md5(strtolower(trim($str)));
    return "http://www.gravatar.com/avatar/$hash?s=$size";
}