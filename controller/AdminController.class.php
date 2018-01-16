<?php
require_once 'autoloader.php';

class AdminController extends Controller{
    
    public function editProducts(Request $request){
        $this->data = Product::getAllProducts();
        return "editProducts";
    }

    public function deleteProduct(Request $request){
        $id=$request->getParameter("id", 0);
        try{
            $product= Product::getById($id);
            $product->delete();
        }catch(Exception $ex){
            $this->message = "Id to delete not found";
        }
        return $this->editProducts($request);
    }

    public function saveProduct(Request $request){
        $errMsg = "";
        $id = $_POST['id'];
        $name = $_POST['name'];
        $code = $_POST['code'];
        $img = $_POST['img'];
        $price = $_POST['price'];
        $product;
        if($id!="0"){
            $product = Product::getById($id);
        }
        else{
            $product = new Product();
        }
        $product->setName($name);
        $product->setCode($code);
        $product->setImage($img);
        $product->setPrice($price);
        $product->saveToDb();
        return $this->editProducts($request);
    }

    public function checkAllOrders(Request $request){
        
    }

    public function editProductView(Request $request){
        $id=$request->getParameter("id", 0);
        try{
            $product= Product::getById($id);
            $this->data[] = $product;
        }catch(Exception $ex){
            $this->message = "Id to edit not found";
            return "editProducts";
        }
        return "editForm";
    }

    public function addProductView(Request $request){
        return "editForm";
    }

}