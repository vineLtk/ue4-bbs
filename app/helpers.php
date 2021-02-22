<?php


/**
 * 获取当前路由名称转换为CSS类名
 */
function route_class(){
    return str_replace('.', '-', Route::currentRouteName());
}