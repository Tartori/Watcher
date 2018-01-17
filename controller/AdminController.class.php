<?php
require_once 'autoloader.php';

class AdminController extends Controller{
    
    public function editProducts(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $this->data = Product::getAllProducts();
        $this->title = t("editProducts");

        return "editProducts";
    }

    public function deleteProduct(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $id=$request->getParameter("id", 0);
        try{
            $product= Product::getById($id);
            $product->delete();
        }catch(Exception $ex){
            $this->message = t("IdDelete");
        }
        return $this->editProducts($request);
    }

    public function saveProduct(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
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
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $shoppingCart = new ShoppingCart();
        $this->data = $shoppingCart->getAllOrders();
    }

    public function orderDetail(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $id=$request->getParameter("id", 0);
        $shoppingCart = new ShoppingCart();
        $this->data = $shoppingCart->getOrderDetails($id);
        $this->title = t("orderDetail");
    }

    public function editProductView(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $id=$request->getParameter("id", 0);
        try{
            $product= Product::getById($id);
            $this->data[] = $product;
        }catch(Exception $ex){
            $this->message = t("IdDelete");
            return $this->editProducts($request);
        }
        $this->title=t("changeProduct");
        return "editForm";
    }

    public function addProductView(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = t("requireLogin");
            $this->title=t("login");
            return "login";
        }
        $this->title = t("addProduct");
        return "editForm";
    }

}