<?php
namespace App\Controllers;

use App\Models\Order;


class OrderManagementController extends Controller{

    public function index(){
        $model = new Order($this->getDB());
        
        $orders = $model->getOrders();
        return $this->view('orderManagement.index', compact('orders'));
    }
    public function destroy(int $id){
        $model = new Order($this->getDB());
        
        $model->rejectOrder($id);
        
        return header('location: /e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/');
        
    }
    public function show(int $id)
        {
        $orders = new Order($this->getDB());
        $order =$orders->getOrderById($id);
        $product = $orders->getProductByOrder($id);
        
            return $this->view("orderManagement.order",compact('order','product'));
        }
        
    public function accept(int $id){
        $orders = new Order($this->getDB());
        $orders->acceptOrder($id);
        
        return header('location: /e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/');
        
    }
    public function validate(int $id){
        $orders = new Order($this->getDB());
        $orders->validateOrder($id);

        return header('location: /e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/');
    }
    public function archive(int $id){
        $orders = new Order($this->getDB());
        $orders->archive($id);
        
        return header('location: /e-commerce-BTS-SIO/E-Commerce/orderManagement/orders/');
    }
    public function archived(){
        $_archived = new Order($this->getDB());
        $_archived = $_archived->isArchived();
        

        return $this->view('orderManagement.orderArchived',compact('_archived'));
    }
    public function search(){
        $model = new Order($this->getDB());
        

            $orders = $model->searchOrder($_POST['name'],$_POST['status']);
            return $this->view('orderManagement.index', compact('orders'));
    }
    }


