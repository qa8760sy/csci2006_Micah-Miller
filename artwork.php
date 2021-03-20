<?php 
require_once "DBMod.php";
class Artwork extends DBMod{

            private $artworkID;
            private $artworkArtist;
            private $artWorkName;
            private $artworkLocation
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
            $this->artworkID = $constructorVariable['artworkID'];
            $this->artworkArtist = $constructorVariable['artworkArtist'];
            $this->artWorkName = $constructorVariable['artWorkName'];
            $this->artWorkLocation = $constructorVariable['artWorkLocation']
            $this->price = $constructorVariable['price'];
            $this->description = $constructorVariable['description'];

        }
        protected function insertSQL($valueOne,$valueTwo,$valueThree,$valueFour,$valueFive,$valueSix){
            $sql = "INSERT INTO artwork (artwork_id, artwork_artist, artwork_name, artwork_loc, atwork_reprintPrice, artwork_desc)
            VALUES ('$valueOne','$valueTwo','$valueThree','$valueFour','$valueFive','$valueSix')";
            return $sql;
        }
        protected function updateSQL($id, $valueOne,$valueTwo,$valueThree,$valueFour,$valueFive,$valueSix){ //Still doesnt feel right
            $sql = "INSERT INTO artwork (artwork_id, artwork_artist, artwork_name, artwork_loc, atwork_reprintPrice, artwork_desc)
            VALUES ('$valueOne','$valueTwo','$valueThree','$valueFour','$valueFive','$valueSix')
            WHERE artwork_id=$id";
            return $sql;
        }
        protected function deleteSQL($value){
            $sql = "DELETE FROM artwork WHERE artwork_id=$value";
            return $sql;
        }

        static function getAllartwork(){
            $sql = "SELECT *
            FROM artwork";
            $results = $pdo ->query($sql);
            $arrayValues=array();
            while($row = $results->fetch()){
              $arrayValues[$row["artwork_id"]] =$row["artwork_fullartworkArtist"];
            }
            return $arrayValues;
        }

        public function getData($id){        
            $sql = "SELECT *
            FROM artwork
            where artwork_id = $id";
            
            $results = $pdo ->query($sql);
            while($row = $results->fetch()){
               return $row;
            }
        }

        public function toHTML(){ //pg. 1118    sanders-assignment4-40:59
            $theValues = array($this->getartworkID(),$this->getartworkArtist(),$this->getartWorkName(),$this->getartWorkLocation(),$this->getprice(),$this->getdescription());
            $printOut = "<ul>";
            foreach($theValues as $value){
                $printOut .= "<li>". $value . "</li>";
            }
            $printOut .="</ul>";
            return $printOut;
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
            return $this->artWorkName;
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
    }
    
    ?>
