<?php

class DB {
    private PDO $pdo;
    private $database;
    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function connect( $host, $user, $password, $database, $port = 3306 ) {
        $this->database = $database;
        $this->pdo = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database, $user, $password);
    }

    public function get_database() {
        return $this->database;
    }

    public function query( $query ) {
        $sql = $this->pdo->prepare( $query );
        $result = $sql->execute();

        $operator = strtok($query, " ");
        if ( !in_array( $operator, array( "SELECT", "DESCRIBE", "SHOW" ) ) ) {
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