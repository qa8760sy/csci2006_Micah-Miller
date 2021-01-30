<?php 
 //never used
// include ("auxillary/default.css");

// $concatenation = '<!DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.$title.'<link rel="stylesheet" href="auxillary/default.css"></head>';

// function printTitle(){
//     echo "$title";
// }
/*

*/ 



function printTitle(){
    $title = "Lebrun - Self-portrait in a Straw Hat";
    return $title;
    // echo '<!DOCTYPE html>
    // <html lang="en">
    
    // <head>
    //     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    //     $value;
    //     '<link rel="stylesheet" href="auxillary/default.css">
    // </head>';

}

// function printHeader(){
//     echo '<!DOCTYPE html>
//     <html lang="en">
    
//     <head>
//         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
//         <title>Lebrun - Self-portrait in a Straw Hat</title>
//         <link rel="stylesheet" href="auxillary/default.css">
//     </head>';

// }

function printBody(){
    
    // $productDetails = array(
    //     array(
    //         "facet" => "Date", 
    //         "links" => array(
    //             array(
    //                 "text" => "1782"
    //             )
    //         )
    //     ),
    //     array(
    //         "facet" => "Medium", 
    //         "links" => array(
    //             array(
    //                 "text" => "Oil on canvas",
    //             )
    //         )
    //     ),
    //     array(
    //         "facet" => "Dimension", 
    //         "links" => array(
    //             array(
    //                 "text" => "98cm x 71cm"
    //             )
    //         )
    //     ),
    //     array(
    //         "facet" => "Home", 
    //         "links" => array(
    //             array(
    //                 "text" => "National Gallery, London",
    //             )
    //         )
    //     ),
    //     array(
    //         "facet" => "Genres", 
    //         "links" => array(
    //             array(
    //                 "text" => "Realism",
    //                 "href" => "#"
    //             ),
    //             array(
    //                 "text" => "Rococo",
    //                 "href" => "#"
    //             ),            
    //         )            
    //     ),
    //     array(
    //         "facet" => "Subjects", 
    //         "links" => array(
    //             array(
    //                 "text" => "People",
    //                 "href" => "#"
    //             ),
    //             array(
    //                 "text" => "Arts",
    //                 "href" => "#"
    //             )
    //         )
    //     ),
    // );    
    
    // $productDetailsHtml = "";
    // foreach($productDetails as $product) {        
    //     $productDetailsHtml .= '<tr><td class="facet">'. $product["facet"] . ':</td><td class="value">';
    //         $links = array();
    //         foreach($product["links"] as $link) {
    //             if(isset($link["href"])) {
    //                 $text = '<a href="' . $link["href"] . '">' . $link['text'] . '</a>';
    //             } else {
    //                 $text = $link["text"];
    //             }
    //             array_push($links, $text);
    //         }
    //         $productDetailsHtml .= join(", ", $links);
    //         $productDetailsHtml .= '</td></tr>';
    // }

    $firstNavigation=array("my account", "wish list", "shopping cart");
    $navstr = "<ul>";
    foreach($firstNavigation as $values){
        $navstr.="<li> <a href=\"#\">".$values."</a>  </li>";
    }
    $navstr.="</ul>"; 

    $secondNavigation = ["Home", "About us", "Art Works", "Artists"];
    $navstrTwo = "<ul>";
    foreach($secondNavigation as $values){
        $navstrTwo.="<li> <a href=\"#\"> $values </a> </li>";
    }
    $navstrTwo.="</ul>";

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
    // $artWorkTitle= array("Still Life with Flowers in a Glass Vase","Portrait of Alida Christina Assink","Self-portrait","William II, Prince of Orange, and his Bride, Mary Stuart","Milkmaid");
    // $imageLocation= ("artwork/small/293.jpg\"", "artwork/small/183.jpg\"","artwork/small/820.jpg\"","artwork/small/374.jpg\"","artwork/small/849.jpg\"");
    // $imageHref=("#293","#183","#820", "#374","#849");
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
    <header>
        <nav class="user">$navstr</nav>
        <h1>Art Store</h1>
        <nav>$navstrTwo</nav>
    </header>
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
    <footer>
        <p>All images are copyright to their owners. This is just a hypothetical site ©2020 Copyright Art Store</p>
    </footer>
</html>
__html__;
}
?>