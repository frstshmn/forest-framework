<?php

require_once __DIR__ . "/../../Loader.php";

abstract class Model {
    protected $DB;
    protected $token;

    public function __construct($token = false) {
        $this->token = $token;
        $loader = Loader::getInstance();
        $db_connection = $loader->getDBCredentials();
        if ( $this->DB = new PDO("mysql:host=" . $db_connection['host'] . ";dbname=" . $db_connection['database'] . "", $db_connection['user'], $db_connection['password'] ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdByToken() {
        if( $result = $this->DB->query("SELECT `id` from `users` WHERE `access_token` = '" . $this->token . "'")->fetchAll(PDO::FETCH_ASSOC) ) {
            return $result[0]['id'];
        } else {
            return false;
        }
    }

    public function isAdmin() {
        if( $result = $this->DB->query('SELECT is_admin from users WHERE access_token = "' . $this->token . '"')->fetchAll(PDO::FETCH_ASSOC) ) {
            return $result[0]['is_admin'];
        } else {
            return false;
        }
    }

    public function SQL( $query, $result = "fetchAll(PDO::FETCH_ASSOC)" ) {
        if( $result = $this->DB->query($query)->$result ) {
            return $result;
        } else {
            return false;
        }
    }

}