<?php
class Schema
{
    public $build_query;
    public $table;
    public $method;
    public $extras;
    public $engine;
    public $primary_data;

    public function __construct($table)
    {
        $this->table = $table;
        $this->method = 'create';
        $this->build_query =
            'CREATE TABLE IF NOT EXISTS ' .
            $table .
            ' (
id int(11) NOT NULL AUTO_INCREMENT,
';
        $this->extras = '';
        $this->engine = 'InnoDB';
        $this->primary_data = '';
    }

    public function drop_before_build()
    {
        $this->build_query =
            'DROP TABLE IF EXISTS ' .
            $this->table .
            '; CREATE TABLE ' .
            $this->table .
            ' (
id int(11) NOT NULL AUTO_INCREMENT,
';

        return $this;
    }

    public function create()
    {
        $this->method = 'create';
    }

    public function add_column()
    {
        $table = $this->table;
        $this->method = 'add_column';
        $this->build_query = 'ALTER TABLE ' . $table . ' ';
    }

    public function drop_column()
    {
        $table = $this->table;
        $this->method = 'drop_column';
        $this->build_query = 'ALTER TABLE ' . $table . ' ';
    }

    public function select($column)
    {
        $this->build_query .= 'DROP ' . $column . ', ';
        return $this;
    }

    public function add_foreign_key($columns, $table, $f_columns)
    {
        if (
            !isset($columns) ||
            !is_array($columns) ||
            !isset($table) ||
            !isset($f_columns) ||
            !is_array($f_columns)
        ) {
            return;
        }
        $this->build_query .=
            ' FOREIGN KEY (' .
            implode(',', $columns) .
            ') REFERENCES ' .
            $table .
            '(' .
            implode(',', $f_columns) .
            ') ON DELETE CASCADE, ';
    }

    public function add($name, $type = 'text', $length = '', $default = '')
    {
        //Apply logic to create order
        $l = '';

        if ($length != '') {
            $l = '(' . $length . ')';
        }
        if ($default != '') {
            $d = ' NOT NULL DEFAULT \'' . $default . '\'';
        } else {
            $d = '';
        }

        $method = $this->method;

        if ($method == 'create') {
            $this->build_query .=
                '`' .
                $name .
                '` ' .
                $type .
                '' .
                $l .
                $d .
                ',
';
        } elseif ($method == 'add_column') {
            $this->build_query .=
                'ADD ' . $name . ' ' . $type . '' . $l . $d . ', ';
        } else {
        }

        return $this;
    }

    public function add_extras($extras)
    {
        $this->extras .= $extras;
    }

    public function set_engine($engine)
    {
        $this->engine = $engine;
    }

    public function add_primary_data($data)
    {
        $this->primary_data = '; INSERT INTO `' . $this->table . '` ' . $data;
    }

    public function column()
    {
        $this->build_query = '';
    }

    public function save($type = 'execute')
    {
        $method = $this->method;

        if ($method == 'create') {
            $this->build_query .=
                'PRIMARY KEY ( id ) ' .
                $this->extras .
                '
) ENGINE=' .
                $this->engine .
                '  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1' .
                $this->primary_data;

            if ($type == 'show_sql') {
                return $this->build_query;
            }

            try {
                $d = ORM::execute($this->build_query);
                return $d;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } elseif ($method == 'add_column') {
            $build_query = $this->build_query;
            $build_query = substr($build_query, 0, -2);

            try {
                $d = ORM::execute($build_query);
                return $d;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return false;
        }
    }

    public function drop()
    {
        $method = $this->method;

        if ($method == 'create') {
            try {
                $d = ORM::execute('DROP TABLE IF EXISTS ' . $this->table);
                return $d;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } elseif ($method == 'drop_column') {
            $build_query = $this->build_query;
            $build_query = substr($build_query, 0, -2);

            try {
                $d = ORM::execute($build_query);
                return $d;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return false;
        }
    }
}
