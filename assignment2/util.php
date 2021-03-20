<?php 


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
    $title = "Lebrun - Self-portrait in a Straw Hat";
    return $title;
}
function htmlHeader(){
    $firstNavigation=array(
        array(
            "title" => "my account",
            "href" => "?pg=account",
        ),
        array("title" => "wish list",
              "href" => "#"
        ),
        array("title" => "shopping cart",
              "href" => "#",
        ),
    );
    $navstr = "<ul>";
    foreach($firstNavigation as $values){
        $navstr.="<li> <a href=\"{$values["href"]}\">" . $values["title"] . "</a>  </li>";
    }
    $navstr.="</ul>"; 

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
            "href" => "?pg=artists"
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
        </article>
    </main>
</html>
__html__;
}

function connectToDb(){
    global $connectionString, $dbUserName, $dbPassword;
   try{
    $pdo = new PDO($connectionString, $dbUserName, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} 
catch (PDOException $e){
    die( $e->getMessage() );
}
}

function aboutus(){
    $html ="";
    return $html;
}

function home(){
    $html ="";
    return $html;
}

function artistss(){
   $arrayValues = artist::getAllArtists();
   $html = "<ul>";
   foreach($arrayValues as $id=>$values){
    $html .= "<li><a href=\"?pg=artist&artist=$id\">$values</a></li>";
   }return 
   $html . "</ul>";
}
function artWorkss(){
    $arrayValues = artist::getAllArtists();
    $html = "<ul>";
    foreach($arrayValues as $id=>$values){
     $html .= "<li><a href=\"?pg=artist&artist=$id\">$values</a></li>";
    }return 
    $html . "</ul>";
    
 }
?>