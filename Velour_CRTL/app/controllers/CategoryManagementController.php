<?php
namespace App\Controllers;
use App\Models\Category;

class CategoryManagementController extends Controller{
    
    public function index(){

        $model = new Category($this->getDB());
        $categories = $model->all();

        return $this->view('categoryManagement.index', compact('categories'));
    }

    public function destroy($id)
{
    $model = new Category($this->getDB());
    $deleted = $model->destroyCategory($id);

    return header('location: /E-Commerce-BTS-SIO/E-Commerce/categoryManagement');

}

public function research()
{
    $model = new Category($this->getDB());
    $categories = $model->searchCategory($_POST['search']);

    return $this->view('categoryManagement.index', compact('categories'));
}

public function update(int $id)
{
    $category = new Category($this->getDB());
    $result = $category->update($id, $_POST);
    if($result){
        return header('location: /E-Commerce-BTS-SIO/E-Commerce/categoryManagement');
    }
}

public function create()
    {
        return $this->view("categoryManagement.create");
    }

    public function createCategory()
    {
        $category = new Category($this->getDB());
        $result = $category->create($_POST);
        if($result){
            return header('location: /E-Commerce-BTS-SIO/E-Commerce/categoryManagement');
        }
    }

}