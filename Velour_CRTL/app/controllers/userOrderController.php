<?php
namespace App\Controllers;

use App\Models\Order;


class userOrderController extends Controller{

    public function index(){
        $model = new Order($this->getDB());
        
        $orders = $model->getUserOrders($_SESSION['user_id']);
        return $this->view('userOrder.index', compact('orders'));
    }

    public function show(int $id)
    {
        $orders = new Order($this->getDB());
        $order =$orders->getOrderById($id);
        $product = $orders->getProductByOrder($id);
        
            return $this->view("userOrder.show",compact('order','product'));
        }
}


