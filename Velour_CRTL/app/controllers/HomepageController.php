<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;


class HomepageController extends Controller
{
    public function index()
    {
        $model = new Product($this->getDB());
        $category = new Category($this->getDB());
        $homepage = $model->getProductsByLastAdd();
        $categories = $category->all();
        $randomBooks = $model->getRandomProductsByCategory(3);
        $randomElectronic = $model->getRandomProductsByCategory(1);
        $randomClothing = $model->getRandomProductsByCategory(2);
        
        return $this->view('homepage.index', compact('homepage','categories','randomBooks','randomElectronic','randomClothing'));
    }
    public function search()
    {
        $model = new Product($this->getDB());
        $search = $_POST['name'] ?? '';
        $category = $_POST['categories'] ?? '';
        $homepage = $model->searchProductByNameAndCategory($search, $category);
        $categoryModel = new Category($this->getDB());
        $categories = $categoryModel->all();
        
        
        if($search == "" && $category == "") {
            header('Location: /e-commerce-BTS-SIO/E-Commerce/homepage');
        }else{
        
        return $this->view('homepage.search', compact('homepage','categories'));
    }

}
}
