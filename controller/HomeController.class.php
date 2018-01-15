<?php
require_once 'autoloader.php';

class HomeController extends Controller{
    public function doNotRequireLogin() {
		return ["index", "Contact", "Login", "AddItemToShoppingCart", "GetItemDetailView", "GetShoppingCart"];
	}
    public function index(Request $request){

    }

    public function products(Request $reqest){
        
    }
    
    public function info(Request $reqest){
        
    }

    public function home(Request $request){

    }

    public function contact(Request $request){
       $this->title = "Contact";
    }

    public function login(Request $request){
       
    }

    public function dologin(Request $request){
        if($request->isParameter('email'))
            $email = $request->getParameter('email', '');
        if($request->isParameter('pw'))
            $pw = $request->getParameter('pw', '');
        
        $user = User::login($email, $pw);

        echo($user->__toString());
        
        $_SESSION["user"] = $user;
        $_SESSION["isLoggedIn"]=true;

        return "Home";
    }

    public function logout(Request $request){

        $_SESSION["user"] = null;
        $_SESSION["isLoggedIn"]=false;
        
        return "Home";
    }

    public function addItemToShoppingCart(Request $request){

    }

    public function getShoppingCart(Request $request){

    }

    public function getItemDetailView(Request $request){

    }
    public function register(Request $request){

    }

    public function doregister(Request $request){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $plz = $_POST['plz'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $cemail = $_POST['cemail'];
        $pw = $_POST['pw'];
        $cpw = $_POST['cpw'];

        $user = User::create($username, $firstname, $lastname, $address, $plz, $city, $email, $pw);


        echo($user->__toString());

        $mailer = new RegisterMailer("julianstampfli4@gmail.com", $user->__toString());

        if(!$mailer->sendMail()){
            echo "Mailer Error: " . $mailer->getExceptionDetails();
        }else {
            echo "mail sent sucessfully";
        }
        
        return "Home";        
    }

}