<?php
namespace App\Controllers;
use App\Models\Cart;

class CartController extends Controller{

    public function index(){
        $cart = json_decode($_GET['cart'], true);
        $ids = [];
        foreach($cart as $item) {
            $ids[] = $item['id'];
        }

        $model = new Cart($this->getDB());
        $products = $model->getCart($ids);

        return $this->view('cart.index', compact('products'));
    }
}   