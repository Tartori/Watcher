<?php
require_once 'autoloader.php';

class HomeController extends Controller{
    public function doNotRequireLogin() {
		return ["index", "Contact", "Login", "AddItemToShoppingCart", "GetItemDetailView", "GetShoppingCart"];
	}
    public function index(Request $request){

    }

    public function contact(Request $request){
       $this->title = "Contact";
    }

    public function login(Request $request){

    }

    public function logout(Request $request){

    }

    public function addItemToShoppingCart(Request $request){

    }

    public function getShoppingCart(Request $request){

    }

    public function getItemDetailView(Request $request){

    }
    public function register(Request $request){

    }

}