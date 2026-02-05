<?php
namespace App\controllers;
use App\controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class productManagementController extends Controller{

    public function index()
    {
        $product = new Product($this->getDB());
        $products = $product->all();

        $category = new Category($this->getDB());
        $category = $category->all();

        return $this->view("productManagement.index", compact('products', 'category'));
    }

    public function research()
    {
        $product = new Product($this->getDB());
        $products = $product->findByNameAndCategory($_POST['name'], $_POST['id_category']);

        $category = new Category($this->getDB());
        $category = $category->all();

        return $this->view("productManagement.index", compact('products', 'category'));
    }

    public function edit(int $id)
    {
        $product = new Product($this->getDB());
        $product =  $product->findById($id);

        $category = new Category($this->getDB());
        $category = $category->all();

        return $this->display("productManagement.edit", compact('product', 'category'));
    }

    public function update(int $id)
    {
        $product = new Product($this->getDB());
        $img = $_FILES['url_img'];
        $img_name = $img['name'];

        $targetDirectory = 'C:'.DIRECTORY_SEPARATOR.'xampp'.DIRECTORY_SEPARATOR.'htdocs'.DIRECTORY_SEPARATOR.'E-Commerce-BTS-SIO'.DIRECTORY_SEPARATOR.'E-Commerce'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product';
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0755, true)) {
                die('Echec lors de la création des répertoires...');
            }
        }
        if (!isset($img_name) || !$img_name) {
            die('Le nom du fichier n\'est pas défini ou est invalide.');
        }
        $targetFile = $targetDirectory . DIRECTORY_SEPARATOR . basename($img_name);
        if (!file_exists($img['tmp_name'])) {
            die('Le fichier temporaire n\'existe pas.');
        }
        if (move_uploaded_file($img['tmp_name'], $targetFile)) {
        } else {
            echo 'Erreur lors du téléchargement du fichier. Vérifiez les permissions de dossier et l\'existence du fichier temporaire.';
        }

        $_POST['url_img'] = $img_name;

        $result = $product->update($id, $_POST);
        if($result){
            return header('location: /E-Commerce-BTS-SIO/E-Commerce/productManagement');
        }
    }

    public function destroy(int $id)
    {
        $product = new Product($this->getDB());
        $result = $product->destroy($id);
        if($result){
            return header('location: /E-Commerce-BTS-SIO/E-Commerce/productManagement');
        }
    }

    public function create()
    {
        $category = new Category($this->getDB());
        $category = $category->all();
        return $this->display("productManagement.create", compact('category'));
    }

    public function createProduct()
    {
        $product = new Product($this->getDB());
        $img = $_FILES['url_img'];
        $img_name = $img['name'];

        $targetDirectory = 'C:'.DIRECTORY_SEPARATOR.'xampp'.DIRECTORY_SEPARATOR.'htdocs'.DIRECTORY_SEPARATOR.'E-Commerce-BTS-SIO'.DIRECTORY_SEPARATOR.'E-Commerce'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product';
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0755, true)) {
                die('Echec lors de la création des répertoires...');
            }
        }
        if (!isset($img_name) || !$img_name) {
            die('Le nom du fichier n\'est pas défini ou est invalide.');
        }
        $targetFile = $targetDirectory . DIRECTORY_SEPARATOR . basename($img_name);
        if (!file_exists($img['tmp_name'])) {
            die('Le fichier temporaire n\'existe pas.');
        }
        if (move_uploaded_file($img['tmp_name'], $targetFile)) {
        } else {
            echo 'Erreur lors du téléchargement du fichier. Vérifiez les permissions de dossier et l\'existence du fichier temporaire.';
        }

        $_POST['url_img'] = $img_name;

        $result = $product->create($_POST);
        if($result){
            return header('location: /E-Commerce-BTS-SIO/E-Commerce/productManagement');
        }
    }
}