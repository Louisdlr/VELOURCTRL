<?php
namespace App\controllers;

use App\Models\User;

class UserController extends Controller{

    public function createUser()
    {
        $user = new User($this->getDB());
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $_POST['role'] = 2;
        $count = $user->countByValue($_POST['email'], 'email');
        if($count -> nb == 0)
        {
            $user->create($_POST);
        } else {
            echo "<script>alert('L'email existe déjà');</script>";
        }

        return $this->view("homepage.index");
    }

    public function loginUser()
    {
        $user = new User($this->getDB());
        $user = $user->findByColumn($_POST['email'], 'email');
        var_dump($user);
        if(password_verify($_POST['password'],$user->password) ){      
           if($user->role == true)
           {
                $_SESSION['auth'] = $user->role;
                $_SESSION['user_id'] = $user->id;
                if($user->role == 1){
                    $_SESSION['is_admin'] = true;

                return $this->view("homepage.index");
                }
            return $this->view("homepage.index");

           }
        } else {
            header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
            echo "<script>alert('Le mot de passe ou l'identifiant est incorrect');</script>";
        }
    }

    public function edit(int $id)
    {
        $user = new User($this->getDB());
        $user =  $user->findById($id);
        $address = $user->getAddressById($id);

        return $this->display("user.edit", compact('user', 'address'));
    }

    public function update(int $id)
    {
        $user = new User($this->getDB());
        $user->update($id, $_POST);
        
        header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
        
    }

    public function editMdp(int $id)
    {
        $user = new User($this->getDB());
        $user =  $user->findById($id);

        return $this->display("user.editMdp", compact('user'));
    }

    public function updateMdp(int $id)
    {
        $user = new User($this->getDB());
        $user->updateMdp($id, $_POST);
        
        header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
        
    }

    public function show_CreateAddress(int $id)
    {
        $user = new User($this->getDB());
        $user =  $user->findById($id);
        return $this->display("user.adress", compact('user'));
    }

    public function createAddress(int $id){

        $user = new User($this->getDB());
        $address = $user->createAddress($id, $_POST);

        header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');

    }
    public function show_EditAddress(int $id)
    {
        $user = new User($this->getDB());
        $user =  $user->findById($id);
        $address = $user->getAddressById($id);
        return $this->display("user.editAddress", compact('user', 'address'));
    }
    public function editAddress(int $id){
        
        $user = new User($this->getDB());
        $newAddress = $user->updateAddress($id, $_POST);
        
        header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
        
    }
}