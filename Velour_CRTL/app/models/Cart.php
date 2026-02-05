<?php

namespace App\Models;
use Database\DBConnection;

class Cart extends Model
{

    protected $table ="products";

    public function getCart($ids)
    {
        $products = [];
        if (empty($ids)) {
            return $products;
        }
        foreach ($ids as $id) {            
            $products[] = $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
        }
        return $products;
    }

}