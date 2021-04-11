<?php 
// think i need to include my classes?
include_once("artist.php");
include_once("artwork.php");

function accountDetails(){
    $stAddress = "123 aStPlace";
    $username = "UserPrimeUlimateMAXIMUMER!";
    $password ="PASSWERDD";
    $stAddressTwo ="";
    $city = "crazyTown";
    $state ="funStatE";
    $zipCode= "55689";

    if(isset($_POST["stAddress"])){
        $stAddress = $_POST["stAddress"];
    }
    if(isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if(isset($_POST["password"])){
        $password = $_POST["password"];
    }
    if(isset($_POST["city"])){
        $city = $_POST["city"];
    }
    if(isset($_POST["state"])){
        $state = $_POST["state"];
    }
    if(isset($_POST["stAddressTwo"])){
        $stAddressTwo = $_POST["stAddressTwo"];
    }
    if(isset($_POST["zipCode"])){
        $zipCode = $_POST["zipCode"];
    }

   return
    <<<__html__
    <form method ="POST" action="?pg=account">
        <feildset>    
            <legend>My account</legend><br>
                <label>User Name</label>
                <input type="text" name="username" value="{$username}" />
                <label>Password</label>
                <input type="password" name="password" value="{$password}"/><br><br>
                <label>Address</label>
                <input type="text" name="stAddress" value="{$stAddress}"/> 
                <input type="text" name="stAddressTwo" value="{$stAddressTwo}"/> <br>
                <label>City</label>
                <input type="text" name="city" value="{$city}"/><br>
                <label>State</label>
                <input type="text" name="state" value="{$state}"/><br>
                <label>Zip Code</label>
                <input type="text" name="zipCode" value="{$zipCode}" />
                <br><br>
                <input type="submit" value="Save Changes"/><br><br>
        </fieldset>
    </form>
    __html__;
}

function printTitle(){
    $title = "Lebrun - Self-portrait in a Straw Hat"; //will need to change this to by dynamic i think.
    return $title;
}

function navBars(){
    if(isLoggedIn()){
        $firstNavigation=array(
        array(
            "title" => "my account",
            "href" => "?pg=account",
        ),
        array("title" => "wish list",
              "href" => "?pg=wishlist"
        ),
        array("title" => "shopping cart",
              "href" => "?pg=shoppingcart",
        ),
        array("title" => "Logout",
              "href" => "?logout"),
    );
    $navstr = "<ul>";
    foreach($firstNavigation as $values){
        $navstr.="<li> <a href=\"{$values["href"]}\">" . $values["title"] . "</a>  </li>";
    }
    $navstr.="</ul>"; 
    return $navstr;
    }else{
        $firstNavigation = array(array(
            "title" => "Sign-in",
            "href" => "?pg=Sign-in",
        ),
        array("title" => "Sign-up",
              "href" => "?pg=Sign-up"
        ),
        array("title" => "shopping cart",
              "href" => "?pg=shoppingcart",
        ),
    );
        $navstr = "<ul>";
    foreach($firstNavigation as $values){
        $navstr.="<li> <a href=\"{$values["href"]}\">" . $values["title"] . "</a>  </li>";
    }
    $navstr.="</ul>"; 
    return $navstr;
    }
    
}

function htmlHeader(){

    $navstr = navBars();

    $secondNavigation = array(
        array(
            "title" =>"Home",
            "href" => "?pg=home",
            ),
        array(
            "title" =>"About us",
            "href" => "?pg=aboutUs"
            ),
        array(
            "title" => "Art Works",
            "href" => "?pg=artWorks"
            ),
        array(
            "title" =>"Artists",
            "href" => "?pg=artist"
            )
        );

    $navstrTwo = "<ul>";
    foreach($secondNavigation as $values){
        $navstrTwo.="<li> <a href=\"{$values["href"]}\"> {$values["title"]} </a> </li>";
    }
    $navstrTwo.="</ul>";
    
    return
    <<<__html__
    <header>
    <nav class="user">$navstr</nav>
    <h1>Art Store</h1>
    <nav>$navstrTwo</nav>
    </header>
__html__;
}

function footer(){
    return
    <<<__html__
    <footer>
        <p>All images are copyright to their owners. This is just a hypothetical site ©2020 Copyright Art Store</p>
    </footer>
__html__;
}

function printBody(){

    $tableRowOne = array("Date", "Medium", "Dimension", "Home", "Genres", "Subjects");
    
    $artwork = array(
        array(
            "title" => "Still Life with Flowers in a Glass Vase",
            "id" => 293),
        array(
            "title" => "Portrait of Alida Christina Assink",
            "id" => 183),
        array(
            "title" => "Self-portrait",
            "id" => 820),
        array(
            "title" => "William II, Prince of Orange, and his Bride, Mary Stuart",
            "id" => 374),
        array(
            "title" => "Milkmaid",
            "id" => 849),
    );

     $actions = "<div class=\"actions\"><a href=\"#\">View</a><a href=\"#\">Wish</a><a href=\"#\">Cart</a></div>";
    
     $relatedArtHtml = "";
     foreach($artwork as $value) {        
         $relatedArtHtml .= <<<__html__
         <div class="relatedArt">
             <figure><img src="artwork/small/{$value["id"]}.jpg" alt="{$value["title"]}" title="{$value["title"]}">
                 <figcaption>
                     <p><a href="#{$value["id"]}">{$value["title"]}</a></p>
                 </figcaption>
             </figure>
             $actions
         </div>
         __html__;
     }

    return 
    <<<__html__

    <main>
        <article class="artwork">
            <h2 class="art_title">Self-portrait in a Straw Hat</h2>
            <p class="artist">By <a href="#">Louise Elisabeth Lebrun</a></p>
            <figure><img src="artwork/medium/13.jpg" alt="Self-portrait in a Straw Hat" title="Self-portrait in a Straw Hat">
                <figcaption>
                    <p>The painting appears, after cleaning, to be an autograph replica of a picture, the original of which was painted in Brussels in 1782 in free imitation of Rubens’s ’Chapeau de Paille’, which LeBrun had seen in Antwerp. It was
                        exhibited in Paris in 1782 at the Salon de la Correspondance. LeBrun’s original is recorded in a private collection in France.</p>
                    <p class="list_price">$700</p>
                    <div class="actions"><a href="#">Add to Wish List</a><a href="#">Add to Shopping Cart</a></div>
                    <table class="artwork_info">
                        <caption>Product Details</caption>
                        <tbody>
                            <tr>
                                <td class="facet">$tableRowOne[0]:</td>
                                <td class="value">1782</td>
                            </tr>
                            <tr>
                                <td class="facet">$tableRowOne[1]:</td>
                                <td class="value">Oil on canvas</td>
                            </tr>
                            <tr>
                                <td class="facet">$tableRowOne[2]:</td>
                                <td class="value">98cm x 71cm</td>
                            </tr>
                            <tr>
                                <td class="facet">$tableRowOne[3]:</td>
                                <td class="value"><a href="#">National Gallery, London</a></td>
                            </tr>
                            <tr>
                                <td class="facet">$tableRowOne[4]:</td>
                                <td class="value"><a href="#">Realism</a>, <a href="#">Rococo</a></td>
                            </tr>
                            <tr>
                                <td class="facet">$tableRowOne[5]:</td>
                                <td class="value"><a href="#">People</a>, <a href="#">Arts</a></td>
                            </tr>
                        </tbody>
                    </table>
                </figcaption>
            </figure>
        </article>
        <h2>Similar Artwork</h2>
        <article class="related">
        $relatedArtHtml
        </article></main></html>
__html__;
}

$pdo = null;

function connectToDb(){
    global $pdo;
    if($pdo!==null){
        return $pdo;
    }
    include ("config.php");
    // var_dump($connectionString);
   try{
    $pdo = new PDO($connectionString, $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
    } 
    catch (PDOException $e){
        die( $e->getMessage() );
    }
}

function isValidUser($username, $password){
    $pdo = connectToDb();
    $sql = "SELECT customer_id FROM Customer WHERE customer_username=:username AND customer_passhash=:password";
    $stmt = $pdo->prepare($sql);  
    $hashedPassword = md5($username.'SECRET'.$password);
    $stmt->execute(array(":username" => $username, ":password" => $hashedPassword));   //binds the values as well as executes them    
    if($stmt->rowCount() == 0) {
        return false;
    }
    $userData = $stmt->fetch();
    return $userData['customer_id'];
}

function userNameInUse($username){
    $pdo = connectToDb();
    $sql = "SELECT customer_id FROM Customer WHERE customer_username=:username";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute(array(":username" => $username));    

    return $stmt->rowCount() > 0;
}

function prepareSIGNUP(){
    $pdo = connectToDb();
    if(!userNameInUse($username)){
        $signupusername = $_POST['signupUSERNAME'];
        $password = $_POST['signupPASSWORD'];
        $hashedPassword = md5($signupUSERNAME.'SECRET'.$password); 
        $fullName = $_POST['signupFULLNAME'];
        $address= $_POST['signupADDRESS'];
        $sql = "INSERT INTO Customer (customer_username, customer_passhash, customer_fullName, customer_addr)
        VALUES ($signupusername, $hashedPassword, $fullName, $address)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();        
        $_SESSION['currentUser'] = $_POST['signupUSERNAME'];
        // isValidUser($signupusername, $password);
    }else{
        echo "user name already in use";
    }
}

function signIN(){
    $html =<<<__html__
    <fieldset><legend>Sign in</legend>
    <form action="index.php" method="POST">
    <label>User Name</labeL>
    <input type="text" name="username" value="testUser"><br>
    <label>Password</labeL>
    <input type="text" name="password" value="testPassword"><br>
    <input type="submit">
    </form></fieldset>
__html__;
    return $html;
}

function signUP(){
    $html =<<<__html__
    <fieldset><legend>Sign up</legend>
    <form action="index.php" method="POST">
    <label>User Name</labeL>
    <input type="text" name="signupUSERNAME" value=""><br>
    <label>Password</labeL>
    <input type="text" name="signupPASSWORD" value=""><br>
    <label>Full Name</labeL>
    <input type="text" name="signupFULLNAME" value=""><br>
    <label>Address</labeL>
    <input type="text" name="signupADDRESS" value=""><br>
    <input type="submit">
    </form></fieldset>
__html__;
    return $html;
}

function isLoggedIn() {
    return isset($_SESSION['currentUser']);
}

function getCurrentUser() {
    return $_SESSION['currentUser'];
}
function aboutus(){
    $html ="This is an about us page. This art store is entirely fictional, and used for the sole purpose of \"classwork\".";
    return $html;
}

function home(){
    $html ="*insert real content* Home Page, this is more just for testing purposes. That when the button is clicked something different will appear ont he screen";
    return $html;
}

function artistss(){
    $arrayValues = artist::getAllArtist(); //found and extra s at the end here
    $html = "<ul>";
    foreach($arrayValues as $id=>$values){
     $html .= "<li><a href=\"?pg=artist&artist=$id\">$values</a></li>";
    }return 
    $html . "</ul>";
 }

function artWorkss(){
    $arrayValues = artwork::getAllartwork();
    $html = "<ul>";
    foreach($arrayValues as $id=>$values){
     $html .= "<li><a href=\"?pg=artWorks&artwork=$id\">$values</a></li>";
    }return 
    $html . "</ul>";
 }


function buildWishlist(){
    $html = "<h2>Your wishList</h2>";
    $html .= '<table>';
    $results = getWishlist();
    foreach ($results as $key => $value) {
        $html .=  '<tr><td>'.htmlentities(utf8_encode($value['artwork_name'])).'</td>'. '<td></td><td>' . addWishListButtons($value['artwork_id']) .' </td></tr>';
    }
    $html .= '</table>';
    var_dump($results);
    return $html;
}

function addtoWishlist($id){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="INSERT INTO WishlistItem (wl_customer, wl_artwork)
    VALUES ($user, $id) ON DUPLICATE KEY UPDATE wl_customer=wl_customer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();  
}

function getWishlist(){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql = "select artwork.artwork_id, artwork.artwork_name FROM wishlistitem LEFT JOIN
     artwork ON wishlistitem.wl_artwork = artwork.artwork_id LEFT JOIN Customer on 
     wishlistitem.wl_customer = customer.customer_id WHERE wl_customer = $user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
}

function removeFromWishlist($artWorkId){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="DELETE FROM WishlistItem
    WHERE wl_customer=$user
    AND wl_artwork=$artWorkId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
}

function moveFromWishToCart($id){
    addToCart($id);
    removeFromWishlist($id);
}

function addWishListButtons($id){
    return '<form action="?pg=wishlist&" method="post">
    <input type="hidden" name="artworkId" value="'. $id. '" />
    <button type="submit" name="wish" value="removeWishlist">Remove</button>
    <button type="submit" name="wish" value="addToCart">Add to Cart</button></form>';
}

function addButtons($id, $quantity){
    return '<form action="?pg=shoppingcart&" method="post"><input type="text" name="quantity" value="'. $quantity. '" />
    <input type="hidden" name="artworkId" value="'. $id. '" />
    <button type="submit" name="action" value="update">Update Quantity</button>
    <button type="submit" name="action" value="remove">Remove</button></form>';
}

function buildCart(){    
    $html = '<h2>Your cart</h2>';
    $html .= '<table>';
    $results = getCart();
    foreach ($results as $key => $value) {
        $html .=  '<tr><td>'.htmlentities(utf8_encode($value['artwork_name'])).'</td><td>' . addButtons($value['artwork_id'], $value['oi_quantity']) .' </td></tr>';
    }
    $html .= '</table><br><form><button type="submit" name="action" value="order">Place Order</button> </form>';

    return $html;
}

function placeOrder(){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="UPDATE OrderItem
    SET oi_orderNum=?, oi_shippingAddr=?
    WHERE oi_orderNum = -1
    AND oi_customer=$user
    AND oi_artwork=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
}

function updateCart($update, $artworkId){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="UPDATE OrderItem
    SET oi_quantity=$update
    WHERE oi_orderNum = -1
    AND oi_customer=$user
    AND oi_artwork=$artworkId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
}

function removeFromCart($artworkId){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="DELETE FROM OrderItem
    WHERE oi_orderNum = -1
    AND oi_customer=$user
    AND oi_artwork=$artworkId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
}

function addtoCart($id){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="INSERT INTO OrderItem (oi_orderNum, oi_customer, oi_artwork, oi_quantity, oi_shippingAddr)
    VALUES (-1, $user, $id, 1, '') ON DUPLICATE KEY UPDATE oi_quantity=oi_quantity+1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
}

function getCart(){    
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql = "select orderitem.oi_quantity, artwork.* FROM OrderItem LEFT JOIN artwork ON orderitem.oi_artwork = artwork.artwork_id WHERE oi_customer = $user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
}

?>
