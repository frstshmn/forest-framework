<?php

abstract class Controller
{
    //    public function getIdByToken() {
//        if( $result = $this->DB->query("SELECT `id` from `users` WHERE `access_token` = '" . $this->token . "'")->fetchAll(PDO::FETCH_ASSOC) ) {
//            return $result[0]['id'];
//        } else {
//            return false;
//        }
//    }
//
//    public function isAdmin() {
//        if( $result = $this->DB->query('SELECT is_admin from users WHERE access_token = "' . $this->token . '"')->fetchAll(PDO::FETCH_ASSOC) ) {
//            return $result[0]['is_admin'];
//        } else {
//            return false;
//        }
//    }
}