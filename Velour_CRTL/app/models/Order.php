<?php
namespace App\Models;
use Database\DBConnection;

class Order extends Model {
    protected $table = 'orders';


    public function getOrders(){
    return $this->query("SELECT orders.id AS order_id, orders.order_number AS order_number, orders.price AS price, orders.status , orders.id_address AS id_address, users.id AS user_id  , users.email AS email, users.first_name AS firstname, users.last_name AS lastname, users.gender AS gender  
    FROM orders
    INNER JOIN users ON orders.id_user = users.id ");
       
    }
    public function getOrderById(int $id){
        return $this->query("SELECT * FROM orders INNER JOIN users ON orders.id_user = users.id where orders.id =?",[$id],true);
    }

    public function getProductByOrder(int $id){
        //return $this->query("SELECT orders.*,order_product.*, product.* FROM orders INNER JOIN order_product ON orders.id = order_product.id_order INNER JOIN product ON order_product.id_product = product.id where orders.id = ?", [$id]);
        return $this->query("SELECT *  FROM order_products INNER JOIN products ON order_products.id_product = products.id INNER JOIN orders ON order_products.id_order = orders.id where orders.id = ?", [$id]);
        }
    
    public function acceptOrder(int $id){
        $this->query("UPDATE orders SET status = 1 WHERE id = ?", [$id]);
    }
    public function rejectOrder(int $id){
        $this->query("UPDATE orders SET status = 3 WHERE id =?", [$id]);
    }
    public function validateOrder(int $id){
        $this->query("UPDATE orders SET status = 2 WHERE id =?", [$id]);
    }
    
    public function archive(int $id){
        $this->query("UPDATE orders SET status = 4 WHERE id =?", [$id]);
    }
    
    public function isArchived(){
        return $this->query("SELECT orders.id AS order_id, orders.order_number AS order_number, orders.price AS price, orders.status AS status , orders.id_address AS id_address, users.id AS user_id  , users.email AS email, users.first_name AS firstname, users.last_name AS lastname, users.gender AS gender  
        FROM orders
        INNER JOIN users ON orders.id_user = users.id WHERE orders.status = 3 OR orders.status = 4 ");  
}
    public function isArchivedByStatus($status){
        return $this->query("SELECT orders.id AS order_id, orders.order_number AS order_number, orders.price AS price, orders.status AS status , orders.id_address AS id_address, users.id AS user_id  , users.email AS email, users.first_name AS firstname, users.last_name AS lastname, users.gender AS gender  
        FROM orders
        INNER JOIN users ON orders.id_user = users.id WHERE orders.status = ? ", [$status]);  
    }
    
    public function searchOrder(string $search, $status){
        $stmt = "SELECT orders.id AS order_id, orders.order_number AS order_number, orders.price AS price, orders.status AS status , orders.id_address AS id_address, users.id AS user_id  , users.email AS email, users.first_name AS firstname, users.last_name AS lastname, users.gender AS gender  
        FROM orders
        INNER JOIN users ON orders.id_user = users.id WHERE (orders.order_number LIKE ? OR users.first_name LIKE ? OR users.last_name LIKE ? OR CONCAT(users.first_name, ' ', users.last_name) LIKE ? OR users.email LIKE ?)";
        if ($status != 5){
            $stmt .= " AND orders.status = ?";
            return $this->query($stmt,["%$search%","%$search%","%$search%","%$search%","%$search%", $status]);
        } else {
            return $this->query($stmt,["%$search%","%$search%","%$search%","%$search%","%$search%"]);
        }
        
    }

    public function getUserOrders(int $id){
        return $this->query("SELECT * FROM orders WHERE id_user = ?", [$id]);
    }


}
