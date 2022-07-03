<?php

class DB {
    private PDO $db;
    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function connect( $host, $user, $password, $database, $port = 3306 ) {
        $this->db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database, $user, $password);
    }

    public function query( $query ) {
        $sql = $this->db->prepare( $query );
        $result = $sql->execute();

        if ( strpos( strtoupper( $query ), "SELECT" ) !== 0 ) {
            return $result;
        } else {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
}

function DB() {
    return DB::instance();
}

function SQL( $query ) {
    return DB()->query( $query );
}