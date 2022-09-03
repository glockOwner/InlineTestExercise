<?php
$arr = array(
    'index' => 'index/index',
    'downloadData' => 'index/download',
    'search' => 'search/index',

);
//Проверяем, авторизован ли пользователь
if ($_SESSION['is_auth'] == true)
{
    $arr['cabinet'] = 'cabinet/index'; //actionIndex в CabinetController
}
return $arr;
