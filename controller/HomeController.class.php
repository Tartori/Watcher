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

    public function processOrder(Request $requst){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = "You need to be logged in to use the shopping cart";
            return "login";
        }
        $member_id = $_SESSION["user"];
        $user = User::getById($_SESSION["user"]);

        $shoppingCart = new ShoppingCart();

        /* Calculate Cart Total Items */
        $cartItem = $shoppingCart->getMemberCartItem($member_id);
        $item_quantity = 0;
        $item_price = 0;
        if (! empty($cartItem)) {
            if (! empty($cartItem)) {
                foreach ($cartItem as $item) {
                    $item_quantity = $item_quantity + $item["quantity"];
                    $item_price = $item_price + ($item["price"] * $item["quantity"]);
                }
            }
        }

        $order = 0;
        $order = $shoppingCart->insertOrder ( $user, $item_price);
        if(!empty($order)) {
            if (! empty($cartItem)) {
                if (! empty($cartItem)) {
                    foreach ($cartItem as $item) {
                        $shoppingCart->insertOrderItem ( $order, $item["id"], $item["price"], $item["quantity"]);
                    }
                }
            }
        }
        $mailer = new OrderMailer($user->getEmail(), $order, $item_price);
        $mailer->sendMail();
        $shoppingCart->emptyCart($member_id);
        $this->message = "your order will be processed soon.";
        return "home";
    }

    public function checkout(Request $request){
        $this->data = User::getById($_SESSION["user"]);
        $this->title = "Checkout";
    }

    public function addItemToShoppingCart(Request $request){
        if(!(array_key_exists("user", $_SESSION)&&!is_null($_SESSION["user"]))){
            $this->message = "You need to be logged in to use the shopping cart";
            return "login";
        }
        $member_id = $_SESSION["user"];
        $shoppingCart = new ShoppingCart();
        if (! empty($_POST["quantity"])) {

            $productResult = $shoppingCart->getProductByCode($_GET["code"]);

            $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

            if (! empty($cartResult)) {
                // Update cart item quantity in database
                $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
            } else {
                // Add to cart table
                $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
            }
        }
        return "products";
    }

    public function removeItemToShoppingCart(Request $request){
        $shoppingCart = new ShoppingCart();
        $shoppingCart->deleteCartItem($_GET["id"]);
        return "products";
    }

    public function emptyItemToShoppingCart(Request $request){
        $shoppingCart = new ShoppingCart();
        $shoppingCart->emptyCart($_SESSION["user"]);
        return "products";
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
            $this->message = "you have been registred sucessfully. Please activate your account. ";
        }

        return "Home";
    }
}
