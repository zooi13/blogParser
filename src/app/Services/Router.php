<?php
//Файл для настройки роутинга с единой точкой входа через index
class Router
{
    private static $list = [];
    //добавление страницы в list, который хранит список страниц
    public static function page($uri, $page_name){
        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name
        ];
    }
    //Редирект по нужной странице
    public static function enable(){

        if (isset($_GET['q'])){
            $query = $_GET['q'];
        }else{
            require_once "views/pages/" . 'main' . '.php';
            die();
        }
        foreach (self::$list as $route){
            if ($route['uri'] === $query){
                require_once "views/pages/" . $route['page'] . '.php';
                die();
            }
        }
        self::not_found();
    }
    //Редирект если страница не найдена
    private static function not_found(){
        require_once "views/pages/main.php";
    }
}