<?php

namespace App\Repositories;

use stdClass;

class BaseRepository
{
    protected $db;

    protected $table;

    public function __construct($table = '')
    {
        $this->db = \F3::get('DB');
        $this->table = $table;
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getAll()
    {
        $result = $this->db->exec("SELECT * FROM $this->table");
        return $result;
    }

    public function getById($id)
    {
        $result = $this->db->exec("SELECT * FROM $this->table WHERE id = ?", $id);
        if ($result) {
            $obj = new stdClass();

            foreach ($result[0] as $key => $value) {
                $obj->{$key} = $value;
            }
            return $obj;
        }

        return null;
    }

    public function deleteById($table, $id)
    {
        $this->db->exec("DELETE FROM $table WHERE id = ?", $id);
    }

    // add other common functions here
}