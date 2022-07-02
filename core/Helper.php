<?php

require_once __DIR__ . "/Core.php";

class Helper {
    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function recursive_copy($src, $dst) {
        $dir = opendir($src);
        echo mkdir($dst) ?
            "Created $dst\n" :
            "Failed creating $dst\n";
        while( $file = readdir($dir) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) )
                {
                    $this->recursive_copy($src . '/' . $file, $dst . '/' . $file);
                }
                else {
                    echo copy($src . '/' . $file, $dst . '/' . $file) ?
                        "Created $file\n" :
                        "Failed creating $file\n";
                }
            }
        }
        closedir($dir);
    }

    private function ends_with( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }

    public function plural_form( $string ) {
        if ( $this->ends_with($string, 'y') ) {
            return substr($string, 0, -1) . "ies";
        } else {
            return $string . "s";
        }
    }

    public function api_folder() {
        return __DIR__ . "/../api/";
    }
}

function helper() {
    return Helper::instance();
}