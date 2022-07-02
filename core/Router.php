<?php

class Router
{
    private static $routes = array();

    private function __construct() {}
    private function __clone() {}

    public static function route($method, $pattern, $callback)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';

        if ( is_string( $callback ) ) {
            $callback = explode( "@", $callback );
        }

        self::$routes[$method][$pattern] = $callback;
    }

    public static function execute( $version )
    {

        $url = explode( '?', trim( $_SERVER['REQUEST_URI'],'/') );
        $url = explode( '/', $url[0] );
        unset($url[0], $url[1]);

        $url = implode( '/', $url );

        foreach (self::$routes[ $_SERVER['REQUEST_METHOD'] ] as $pattern => $callback)
        {
            if ( preg_match( $pattern, $url, $params ) )
            {
                array_shift($params);
                if ( is_array( $callback ) ) {
                    include helper()->api_folder() . "/" . $version . "/controllers/" . $callback[0] . ".php";
                    return print call_user_func_array( array( new $callback[0], $callback[1] ), array_values( $params ) );;
                }
                return call_user_func_array($callback, array_values($params));
            }
        }
    }
}