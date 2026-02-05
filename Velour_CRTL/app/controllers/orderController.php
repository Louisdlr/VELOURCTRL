<?php
namespace App\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Address;
use App\Models\OrderProduct;


class orderController extends Controller
{
    public function index()
    {
        $tab_id = $_POST['id'];
        $cpt = 0;
        $total_price = 0;

       foreach ($tab_id as $id) {
           $produc = new Product($this->getDB());
           $productDetails = $produc->findById($id);
           if ($productDetails) {
               $productDetails->quantity = $_POST['productQuantity_'.$id];
               $products[$cpt]['id'] = $productDetails -> id;
               $products[$cpt]['name'] = $productDetails -> name;
               $products[$cpt]['price'] = $productDetails -> price;
               $products[$cpt]['quantity'] = $_POST['productQuantity_'.$id];
               $total_price += $productDetails->price * $productDetails->quantity;
               $cpt++;
           }
       }

        $products['total_price'] = $total_price;

        $model = new Order($this->getDB());
        $orders = $model->findById($id);

        $produc = new Product($this->getDB());
        $product = $produc->findById($id);

        $user = new User($this->getDB());
        $user = $user->findById($_SESSION['user_id']);
        
        

        $address = new Address($this->getDB());
        $address = $address->find_adress($id);

        return $this->view('order.index', compact('orders', 'products', 'user', 'address'));
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        print_r($data);
    
        $tab = array();
    
        $prefixe = 'ORD';
        $longueurTotale = 7;
    
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numero = $prefixe;
        for ($i = strlen($prefixe); $i < $longueurTotale; $i++) {
            $numero .= $caracteres[mt_rand(0, strlen($caracteres) - 1)];
        }
    
        $currentDateTime = date('Y-m-d H:i:s');
    
        $tab['order_number'] = $numero;
        $tab['date_order'] = $currentDateTime;
        $tab['status'] = 1;
        $tab['id_user'] = $data['id_user'];
        $tab['id_address'] = $data['id_address'];
        $tab['price'] = $data['price'];
    
        $model = new Order($this->getDB());
        $result = $model->create($tab);
    
        if ($result) {
            $lastInsertId = $model->recupLastId();
            foreach ($data['products'] as $product) {
                $tab2 = array();
                $tab2['id_order'] = $lastInsertId;
                $tab2['id_product'] = $product['id'];
                $tab2['quantity'] = $product['quantity'];

                $model2 = new OrderProduct($this->getDB());
                $result2 = $model2->create($tab2);
            }
            
        } else {
            echo "La création de l'ordre a échoué.";

        }
    }
}
