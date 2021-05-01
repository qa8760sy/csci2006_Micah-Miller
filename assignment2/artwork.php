<?php 
require_once "DBMod.php";
class artwork extends DBMod{

        private $artworkID;
        private $artworkArtist;
        private $artWorkName;
        private $artworkLocation;
        private $price;
        private $description;

        public $changedFlag = array( 
            'artworkID' => false,
            'artworkArtist' => false,
            'artWorkName' => false,
            'arWorkLocation'=> false,
            'price' => false,
            'description' => false,
            );
        function __construct($intVariable = null){
            parent::__construct($intVariable);
            $constructorVariable  = $this->getData($intVariable);
            $this->artworkID = $constructorVariable['artwork_id'];
            $this->artworkArtist =$constructorVariable['artwork_artist'] ;
            $this->artWorkName= $constructorVariable['artwork_name'];
            $this->artworkLocation =$constructorVariable['artwork_loc'];
            $this->price =$constructorVariable['artwork_reprintPrice'];
            $this->description=$constructorVariable['artwork_desc'];
        }
        
        protected function insertSQL(){
            $sql = "INSERT INTO Artist (artist_id, artwork_artist, artwork_name, artwork_reprintPrice , artwork_loc , artwork_desc )
            VALUES ('$this->id','$this->fullName','$this->lastNmae','$this->price','$this->origin','$this->influence', '$this->description')";
            return $sql;
        }

        protected function updateSQL(){ //There must be a better to update things. IF you only want to update one field needing to type in the other stuff feels like poor programming?
            $sql = "Update Artist Set
            artwork_artist = '$this->fullName',
            artwork_name = '$this->lastNmae',
            artwork_reprintPrice = '$this->price',
            artwork_loc = '$this->influence',
            artwork_desc = '$this->description'
            WHERE artist_id=$this->id";
            return $sql;
        }

        protected function deleteSQL(){
            $sql = "DELETE FROM artwork WHERE artwork_id=$this->id";
            return $sql;
        }

        static function getAllartwork(){
            $sql = "SELECT *
            FROM artwork";
            $pdo = connectToDb();
            $results = $pdo ->query($sql);
            $arrayValues=array();
            while($row = $results->fetch()){
              $arrayValues[$row["artwork_id"]] =$row["artwork_name"]; //Type I think, artwork_fullartworkArtist -> artwork_artworkArtist
            }
            return $arrayValues;
        }

        public function getData($id){        
            $pdo = connectToDb();
            $sql = "SELECT *
            FROM artwork
            where artwork_id = $id";
            
            $results = $pdo ->query($sql);
            while($row = $results->fetch()){
               return $row;
            }
        }

        private function relatedArtWork(){
            $relatedArtHtml = "";
            $artwork = array(
                array(
                    "title" => "Still Life with Flowers in a Glass Vase",
                    "id" => 1),
                array(
                    "title" => "Portrait of Alida Christina Assink",
                    "id" => 20),
                array(
                    "title" => "Self-portrait",
                    "id" => 6),
                array(
                    "title" => "William II, Prince of Orange, and his Bride, Mary Stuart",
                    "id" => 19),
                array(
                    "title" => "Milkmaid",
                    "id" => 15),
            );
            foreach($artwork as $value) {        
                $relatedArtHtml .= <<<__html__
                <div class="relatedArt">
                    <figure><img src="artwork/small/{$value["id"]}.png" alt="{$value["title"]}" title="{$value["title"]}">
                        <figcaption>
                            <p><a href="#{$value["id"]}">{$value["title"]}</a></p>
                        </figcaption>
                    </figure>
                </div>
                __html__;
                
            }
            return $relatedArtHtml;
        }

        private function buttons(){
            if(isset($_SESSION['currentUser'])){
                $buttons = <<<__html__
               <a href="index.php?pg=artWorks&artwork={$this->artworkID}&action=wishlist">Add to Wish List</a><a href="index.php?pg=artWorks&artwork={$this->artworkID}&action=cart">Add to Shopping Cart</a>
               __html__; 
               return $buttons;
            }else{ 
                $buttons = <<<__html__
                <a href="index.php?pg=artWorks&artwork={$this->artworkID}&action=cart">Add to Shopping Cart</a>
                __html__;
                return $buttons;
            }
        }     

        public function getReviews($id){
            $sql = "SELECT *
            FROM reviews WHERE review_artwork = $id";
            $pdo = connectToDb();
            $results = $pdo ->query($sql);
            $html = "";
            while($row = $results->fetch()){
              $html .= 'Anonymous User<br>' . $row["review_text"] . '<hr>'; 
            }
            return $html;
        }

        public function toHTML(){         
            var_dump($this);
            $artist = new artist($this->getartworkArtist());

            $desc = htmlentities(utf8_encode($this->getdescription()));

            // $desc = htmlspecialchars($this->getdescription());
            
            return <<<__html__
            <main>
                <article class="artwork">
                    <h2 class="art_title">{$this->getartWorkName()}</h2>
                    <p class="artist">By <a href="#">{$artist->getfullName()}</a></p>
                    <figure><img src="artwork/medium/{$this->getartworkID()}.png" alt="{$this->getartWorkName()}" title="{$this->getartWorkName()}">
                        <figcaption>
                            <p>{$desc}<p>
                            <p class="list_price">\${$this->getprice()}</p>
                            <table> 
                            <caption>Special Pricing</caption>
                            <tr>
                            <th>Member's price</th>
                            <th>Member Level</th>
                            <th>Savings value<th>
                            </tr>
                            <tr>
                            <td>\${$this->memberPricing(100)}</td>
                            <td>The Aesthete</td>
                            <td>\$100 off</td>
                            </tr>
                            </tr>
                            <tr>
                            <td>\${$this->memberPricing(300)}</td>
                            <td>The Ostridge Aesthete</td>
                            <td>\$200 off</td>
                            </tr>
                            </tr>
                            <tr>
                            <td>\${$this->memberPricing(500)}</td>
                            <td>The Royal Ostridge</td>
                            <td>\$300 off</td>
                            </tr>
                            </table>
                            <div class="actions">{$this->buttons()}</div>
                        </figcaption>
                    </figure>
                    <div style="height:50px;width:200px;">{$this->getReviews($this->getartworkID())}</div>
                </article>
                <h2>Similar Artwork</h2>
                <article class="related">
                {$this->relatedArtWork()}
                </article>
            </main>
        </html>
__html__;
        }


        function memberPricing($startingValue){
            return  $this->getprice() - $startingValue;
        }
        public function setartworkID($artworkID){
            $this->artworkID = $artworkID;
            $this->changedFlag['artworkID'] = true;
        }
        public function setartworkArtist($artworkArtist){
            $this->artworkArtist = $artworkArtist;
            $this->changedFlag['artworkArtist'] = true;
        }
        public function setartWorkName($artWorkName){
            $this->artWorkName = $artWorkName;
            $this->changedFlag['artWorkName'] = true;
        }
        public function setprice($price){
            $this->price = $price;
            $this->changedFlag['price'] = true;
        }
        public function setdescription($description){
            $this->description = $description;
            $this->changedFlag['description'] = true;
        }
        public function setartWorkLocation($artWorkLocation){
            $this->artWorkLocation = $artWorkLocation;
            $this->changedFlag['artWorkLocation'] = true;
        }
        public function getartworkID(){
            return $this->artworkID;
        }
        public function getartworkArtist(){
            return $this->artworkArtist;
        }
        public function getartWorkName(){
            return htmlentities(utf8_encode($this->artWorkName));
        }
        public function getprice(){            
            return $this->price;            
        }
        public function getdescription(){
            return $this->description;
        }
        public function getartWorkLocation(){
            return $this->artWorkLocation;
        }

        public function modifiedInformaiton(){
            foreach($this->changedFlag as $flag=>$bool){
                if($bool){
                    return true;
                }
            }
            return false;
        }
    }
    ?>
