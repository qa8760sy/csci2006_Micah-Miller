<?php 

include_once("artist.php");
include_once("artwork.php");

function accountDetails(){
    $pdo = connectToDb();
    $sql = "SELECT * FROM Customer WHERE customer_id = :id";
    $stmt = $pdo->prepare($sql);  
    $stmt->execute(array(
      ':id'=> $_SESSION['currentUser']
    ));
    $userData = $stmt->fetch();

    $pastOrders = getPastOrders($_SESSION['currentUser']);
    var_dump($pastOrders);
    // need for loop(while?) to loop through each $orderInfo['order_id'] to display as groups. IE: order number 1 'insert orders'. order x 'more orders'.
    return
    <<<__html__
    <div><h3>Welcome {$userData['customer_username']}</h3 
    <p>This is some of your relevant account details.</p>
    <p>Your user name: {$userData['customer_username']}</p>
    <p>Your REAL name: {$userData['customer_fullName']}</p>
    <p>Your membership status: {$userData['customer_membership']}</p>
    <p>Your shipping address: {$userData['customer_addr']}</p>
    </div>
    <br>
    <div>
      <h3>Your Past orders</h3>
        $pastOrders
    </div>
    __html__;
}

function getPastOrders() {
    $pdo = connectToDb();
    $sql = "SELECT * FROM orderitem inner join artwork 
    on artwork_id = oi_artwork where oi_customer= :id order by oi_orderNum";    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id'=> $_SESSION['currentUser']
      ));      
    $orderInfo = $stmt->fetchAll();
    $html = '<table>';
    $previousOrderNumber = -1;
    var_dump($orderInfo);
    foreach ($orderInfo as $order) {
        if($order['oi_orderNum'] == -1) {
            continue;
        } else if($previousOrderNumber != $order['oi_orderNum']) {
            $previousOrderNumber = $order['oi_orderNum'];
            $html .= "<tr class=\"orderHeader\"><td>{$order['oi_orderNum']}</td></tr>";            
        } 
        $html .= "<tr><td>{$order['artwork_name']}</td><td>
            <a href=\"?pg=review&artworkID={$order['oi_artwork']}\">Review product</a></td></tr>"; //here
    }

    $html .= "</table>";
    return $html;
}

function printTitle(){
    $title = "Lebrun - Self-portrait in a Straw Hat"; //will need to change this to by dynamic i think.
    return $title;
}

function navBars(){
    if(isLoggedIn() && $_SESSION['currentUser'] != 'guest'){
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
    var_dump($hashedPassword);
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
    $signupUSERNAME = $_POST['signupUSERNAME'];
    var_dump(userNameInUse($signupUSERNAME));
    if(!userNameInUse($signupUSERNAME)){
        
        $password = $_POST['signupPASSWORD'];
        $hashedPassword = md5($signupUSERNAME.'SECRET'.$password); 
        $fullName = $_POST['signupFULLNAME'];
        $address= $_POST['signupADDRESS'];
        $sql = "INSERT INTO Customer (customer_username, customer_passhash, customer_fullName, customer_addr)
        VALUES ('$signupUSERNAME', '$hashedPassword', '$fullName', '$address')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();        
        $_SESSION['currentUser'] = $_POST['signupUSERNAME'];
    return true;
        // isValidUser($signupusername, $password);
    }else{
        echo "user name already in use";
    }return false;
}

function signIN(){
    $html =<<<__html__
    <fieldset><legend>Sign in</legend>
    <form action="index.php" method="POST">
    <label>User Name</labeL>
    <input type="text" name="username" value="testUser" required><br>
    <label>Password</labeL>
    <input type="text" name="password" value="testPassword" required><br>
    <input type="submit">
    </form></fieldset>
__html__;
    return $html;
}

function signUP(){
    $html =<<<__html__
    <fieldset><legend>Sign up</legend>
    <form action="index.php?pg=signUP" method="POST">
    <label>User Name</labeL>
    <input type="text" name="signupUSERNAME" value="" placeholder="What would you like your username to be?"required><br>
    <label>Password</labeL>
    <input type="text" name="signupPASSWORD" value="" placeholder="enter a secure password"required><br>
    <label>Full Name</labeL>
    <input type="text" name="signupFULLNAME" value="" placeholder="Bob Smithers"required><br>
    <label>Address</labeL>
    <input type="text" name="signupADDRESS" value="" placeholder="123 FunSt Lane new mexico 55104" required><br>
    <input type="submit">
    </form></fieldset>
__html__;
    return $html;
}

function isLoggedIn() {
    return isset($_SESSION['currentUser']);
}

function getCurrentUser() {
    if (!isLoggedIn()){
        return -1;
    }
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
        $html .=  '<tr><td>'.htmlentities(utf8_encode($value['artwork_name'])).'</td>'. '<td></td><td>'
         . addWishListButtons($value['artwork_id']) .' </td></tr>';
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
    $cartTotal = 0;
    if(!isset($_SESSION['coupon'])){
        $_SESSION['coupon'] ="";
    }; //need to include this to stop potential abuse
    $memberPrice = memberPrice();
    foreach ($results as $key => $value) {
        $html .=  '<tr><td>'.htmlentities(utf8_encode($value['artwork_name'])).'</td><td>' .
         addButtons($value['artwork_id'], $value['oi_quantity']) .' </td><td>$' .$value['artwork_reprintPrice'] .
          '*each' . '</td></tr>';
        $cartTotal += ( ($value['artwork_reprintPrice'] - $memberPrice ) * $value['oi_quantity'] );
    }
    if(isset($_POST['couponField'])){
        $_SESSION['coupon'] = $_POST['couponField'];
    }
    $cartTotal = checkForCoupon($_SESSION['coupon'], $cartTotal);
    
    $html .= '</table><br><p>Total: $'. $cartTotal .
    ' .*your member price is included here in the total .</p><br>
    <form action="" method="Post">
    Coupon?
    <input type="text" name="couponField" value="'. $_SESSION['coupon']. '">
    <button type="submit" name="coupon">check code</button>
    <br><br>
    <form action="?pg=shoppingcart&" method="post"><button type="submit" name="action" value="order">Place Order</button></form>';

    return $html;
}

function placeOrder(){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $nextOrder = $pdo->query("SELECT COUNT(*) as nextOrderNumber
    FROM (SELECT COUNT(*) 
    FROM OrderItem
    WHERE oi_orderNum > -1
    GROUP BY oi_orderNum) AS TEMP ");
    $nextOrderNumber = $nextOrder->fetchAll();
    var_dump($nextOrderNumber);
    $sql ="UPDATE OrderItem
    SET oi_orderNum={$nextOrderNumber[0]['nextOrderNumber']}, oi_shippingAddr=''
    WHERE oi_orderNum = -1
    AND oi_customer=$user";
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
    $sql = "select orderitem.oi_quantity, artwork.* FROM OrderItem LEFT JOIN artwork ON orderitem.oi_artwork = artwork.artwork_id 
    WHERE oi_orderNum = -1 AND oi_customer = $user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
}

function memberPrice(){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql = "SELECT customer_membership FROM `customer` WHERE customer_id = $user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    $amountOff = 0;

    if ($result['customer_membership'] == 'aesthete'){
        $amountOff =100 ;
    }else if($result['customer_membership'] == 'ostridgeaesthete'){
        $amountOff =200 ;
    }else if($result['customer_membership'] == 'royalostridge'){
        $amountOff =300 ;
    }else{
        $amountOff = 0;
    }
return $amountOff;
}

function manageablePrice($value){
    return $value / 100;
}

function checkForCoupon($code, $startingValue){ //yea, these should probably be checking against a database value
    if ($code === "artizGRT"){
        $newValue = $startingValue * .95;
        return $newValue;
    }else if($code === "coupin"){
        $newValue = $startingValue * .80;
        return $newValue;
    }else if($code === "woohoo"){
        $newValue = $startingValue * .70;
        return $newValue;
    }else if($code === "baron"){
        $newValue = $startingValue * .15;
        return $newValue;
    }else{
        $newValue = $startingValue;
        return $newValue;
    }
}

function reviewPage($id){
    $artwork = new artwork($id);
    $data ="";
    if(isset($_POST['reviewText'])){
        $reviewText = $_POST['reviewText'];
        submitReview($id, $_SESSION['currentUser'], $reviewText);
        $data= $reviewText;
    }

    $html ='<h2>Reviewing Product for</h2><h3 class="art_title">' . $artwork->getartWorkName(). '</h3>
    <figure><img style=""src="artwork/small/'. $artwork->getartworkID() . '.png" 
                    alt="'. $artwork->getartWorkName().'" title="'. $artwork->getartWorkName().'"></figure>
                    <div style=""><form action="" method="POST" ><label>What are you thoughts on the above piece?</label><br>'
                    . textArea($data).'<br>
                    <input type="submit" value="Share Thoughts"></form></div><br>';
    return $html;
}

function submitReview($artID, $userID, $text){
    $pdo = connectToDb();
    $user = getCurrentUser();
    $sql ="REPLACE INTO `reviews` (`review_customer`, `review_artwork`, `review_text`)
     VALUES ($userID, $artID, '$text');";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
}

function textArea($data){
    $html ='
    <textarea name="reviewText" rows="4" cols="50">' . htmlentities($data). '</textarea>';
    return $html;
}
?>
