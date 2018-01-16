<?php
require_once 'autoloader.php';


$produkte =array();

$verzeichnis = "img/";

class HomeController extends Controller{
    
    public function index(Request $request){
        return "Home";
    }

    public function products(Request $reqest){

    }

    public function edit(Request $request){
        $this->data = User::getById($_SESSION["user"]);
        $this->title = "Edit User";
    }
    
    public function info(Request $reqest){

    }

    public function home(Request $request){
        
    }

    public function contact(Request $request){
       $this->title = "Contact";
       $this->message = "Super Fancy Message";
    }

    public function login(Request $request){

    }

    public function dologin(Request $request){
        if($request->isParameter('email'))
            $email = $request->getParameter('email', '');
        if($request->isParameter('pw'))
            $pw = $request->getParameter('pw', '');
        try{
            $user = User::login($email, $pw);
        }catch (Exception $ex){
            $this->message = $ex->getMessage();
            return "Login";
        }        
        $_SESSION["user"] = $user->getId();
        $_SESSION["isAdmin"]=$user->getIsAdmin();
        $_SESSION["isLoggedIn"]=true;

        $this->message = "$email sucessfully logged in.";

        return "Home";
    }

    public function logout(Request $request){

        $_SESSION["user"] = null;
        $_SESSION["isAdmin"]=false;
        $_SESSION["isLoggedIn"]=false;

        $this->message = "You sucessfully logged out.";
        return "Home";
    }

    public function addItemToShoppingCart(Request $request){
      $db_handle = new DB();
      if(!empty($_POST["quantity"])) {
        $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $db_handle->escapeString($_GET["code"]) . "'");

        $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));

        if(!empty($_SESSION["cart_item"])) {
          if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($productByCode[0]["code"] == $k) {
                  if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                  }
                  $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
          } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
      }
    }

    public function removeItemToShoppingCart(Request $request){
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  }
public function emptyItemToShoppingCart(Request $request){
    unset($_SESSION["cart_item"]);
}


    public function getShoppingCart(Request $request){

    }

    public function getItemDetailView(Request $request){

    }
    public function register(Request $request){

    }

    public function activate(Request $request){
        if(!$request->isParameter("code"))
            return "Home";
        $code = $request->getParameter("code", "");
        try{
            User::activate($code);
        }catch(Exception $ex){
            $this->message = "Invalid Activation Code";
            return "Home";
        }
        $this->message = "Activated successfully";
        return "Home";
    }

    public function doEdit(Request $request){
        $user = User::getById($_SESSION["user"]);
        $errMsg = "";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $plz = $_POST['plz'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $cemail = $_POST['cemail'];
        $pw = $_POST['pw'];
        $cpw = $_POST['cpw'];
        $errMsg = $this->checkFields($firstname, $lastname, $address, $plz, $city, $email, $cemail, $pw, $cpw, true);  
        if($errMsg!==""){
            $this->message = $errMsg;
            $this->data = $user;
            return "edit";
        }
        if($user->getFirstname()!=$firstname){
            $user->setFirstname($firstname);
        }
        if($user->getLastname()!=$lastname){
            $user->setLastname($lastname);
        }
        if($user->getAddressLine()!=$address){
            $user->setAddressLine($address);
        }
        if($user->getPlz()!=$plz){
            $user->setPlz($plz);
        }
        if($user->getCity()!=$city){
            $user->setCity($city);
        }
        if($user->getEmail()!=$email){
            $user->setEmail($email);
        }
        if($pw!=""){
            $user->setPassword($pw);
        }
        $user->saveToDb();
        return "home";
    }
    private function checkFields($firstname, $lastname, $address, $plz, $city, $email, $cemail, $pw, $cpw, $pwMayBeEmpty=false){
        $errMsg="";
        if(!preg_match("/^[a-zA-Z äöüÄÖÜ]+$/", $firstname)){
            $errMsg.="Invalid Firstname<br/>";
        }
        if(!preg_match("/^[a-zA-Z äöüÄÖÜ]+$/", $lastname)){
            $errMsg.="Invalid Lastname<br/>";
        }
        if(!preg_match("/^[a-zA-Z äöüÄÖÜ]+ [\w]+$/", $address)){
            $errMsg.="Invalid Address<br/>";
        }
        if(!preg_match("/^[\d]{4}$/", $plz)){
            $errMsg.="Invalid PLZ<br/>";
        }
        if(!preg_match("/^[\w äöüÄÖÜ]+$/", $city)){
            $errMsg.="Invalid City<br/>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg.= "Invalid Email<br/>";
        }
        if($email!==$cemail){
            $errMsg.="Invalid confirmEmail<br/>";
        } 
        if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d$@$!%*#?&]{8,}$/", $pw)&&!($pwMayBeEmpty&&$pw=="")){
            $errMsg.="Invalid Password<br/>";
        }
        if($pw!==$cpw){
            $errMsg.="Invalid confirmPassword<br/>";
        } 
        return $errMsg;
    }

    public function doregister(Request $request){
        $errMsg = "";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $plz = $_POST['plz'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $cemail = $_POST['cemail'];
        $pw = $_POST['pw'];
        $cpw = $_POST['cpw'];
        $errMsg = $this->checkFields($firstname, $lastname, $address, $plz, $city, $email, $cemail, $pw, $cpw, false);  
        if($errMsg!==""){
            $this->message = $errMsg;
            return "register";
        }
        try{
            $user = User::create($firstname, $lastname, $address, $plz, $city, $email, $pw);
        }catch(Exception $ex){
            $this->message = $ex->getMessage();
            return "register";
        }

        echo($user->__toString());

        $mailer = new RegisterMailer($user);

        if(!$mailer->sendMail()){
            echo "Mailer Error: " . $mailer->getExceptionDetails();
        }else {
            echo "mail sent sucessfully";
        }

        return "Home";
    }
}
