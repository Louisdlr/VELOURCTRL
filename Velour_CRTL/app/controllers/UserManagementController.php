<?php
namespace App\Controllers;
use App\Models\User;

class UserManagementController extends Controller{

    public function index(){

        $model = new User($this->getDB());
        
        $users = $model->all();

        return $this->view('userManagement.index', compact('users'));
    }
public function destroy($id)
{
    $model = new User($this->getDB());
    $deleted = $model->destroyUser($id);

    return header('location: /E-Commerce-BTS-SIO/E-Commerce/user_management');
}

public function update($id)
{
    $model = new User($this->getDB());
    $updated = $model->changeRole($id,$_POST['role']);

    return header('location: /E-Commerce-BTS-SIO/E-Commerce/user_management');
}

public function research()
{
    $model = new User($this->getDB());
    $users = $model->searchUser($_POST['search']);

    return $this->view('userManagement.index', compact('users'));
}

public function show($id)
{
    $model = new User($this->getDB());
    $user = $model->findById($id);

    return $this->view('userManagement.show', compact('user'));
}

} 
