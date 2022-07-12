<?php

require_once __DIR__ . "/../../../core/load.php";

abstract class Model {
    protected string $_table_name;
    protected $_fields;

    function __construct( $properties = false ) {

        $this->_table_name = helper()->plural_form( strtolower( get_called_class() ) );

        if ( $properties == false ) {
            $init_fields = SQL("SHOW COLUMNS FROM " . $this->_table_name);

            foreach ( $init_fields as $field ) {
                $this->init_property( $field['Field'] );
                $this->_fields[] = $field['Field'];
            }
        } else {
            foreach ( $properties as $name => $field ) {
                $this->init_property( $name, $field );
                $this->_fields[] = $name;
            }
        }
    }

    private function init_property($name, $value = null) {
        $this->{$name} = $value;
    }

    public function save() {
        if ( isset( $this->id ) && $this->id != null ) {
            return SQL('UPDATE ' . $this->_table_name . ' SET ' . $this->generate_set_string() . ' WHERE id = ' . $this->id);
        } else {
            return SQL('INSERT INTO ' . $this->_table_name . ' (' . $this->generate_fields_string() . ') VALUES (' . $this->generate_values_string() . ')');
        }
    }

    private function generate_fields_string() {
        return implode(', ', $this->_fields );
    }

    private function generate_values_string() {
        $values = '"';

        foreach ( $this->_fields as $field ) {
            $values .= $this->{$field} . '", "';
        }

        return substr($values, 0, -4) . '"';
    }

    private function generate_set_string() {
        $values = '';

        foreach ( $this->_fields as $field ) {
            $values .= '`' . $field . '` = "' . $this->{$field} . '", ';
        }

        return substr($values, 0, -2);
    }

    public static function get( $query = false ) {
        $_table_name = helper()->plural_form( strtolower( get_called_class() ) );
        $results = SQL('SELECT * FROM ' . $_table_name);

        $objects = array();
        $class = get_called_class();

        foreach ( $results as $result ) {
            $objects[] = new $class( $result );
        }

        return $objects;
    }

}