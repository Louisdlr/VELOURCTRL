<?php

namespace App\Models;
use Database\DBConnection;

class Address extends Model
{
    protected $table ="address";

    public function find_adress(int $id)
    {
        return $this->query("SELECT * FROM {$this->table} INNER JOIN client_address AS A ON A.id_address = {$this->table}.id WHERE A.id_user = ?", [$id]);
    }
}