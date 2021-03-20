<?php 
require_once "DBMod.php";
class artist extends DBMod{    
            private $artistID; 
            private $firstName;
            private $lastName;
            private $influence;
            private $dateOfDeath;
            private $description;
            private $DateOfBirth;
            private $origin

            public $changedFlag = array( 
                'artistID' => false;
                'firstName' => false,
                'lastName' => false,
                'influence' => false,
                'dateOfDeath' => false,
                'description' => false,
                'DateOfBirth' => false,
                'origin' => false,
                );
    // full name, last name, char for influence, description, date of death, char for origin, Date of birth
        function __construct($intVariable = null){
            parent::__construct($intVariable);
            $constructorVariable  = $this->getData($intVariable);
            $this->firstName = $constructorVariable['firstName'];
            $this->lastName = $constructorVariable['lastName'];
            $this->influence = $constructorVariable['influence'];
            $this->dateOfDeath = $constructorVariable['dateOfDeath'];
            $this->description = $constructorVariable['description'];
            $this->DateOfBirth = $constructorVariable['DateOfBirth'];
            $this->origin = $$constructorVariable['origin'];
        }
        
        protected function insertSQL($valueOne,$valueTwo,$valueThree,$valueFour,$valueFive,$valueSix, $valueSeven,$valueEight){
            $sql = "INSERT INTO Artist (artist_id, artist_fullName, artist_lastName , artist_born , artist_died , artist_origin , artist_influence , artist_desc )
            VALUES ('$valueOne','$valueTwo','$valueThree','$valueFour','$valueFive','$valueSix','$valueSeven','$valueEight')";
            return $sql;
        }
        protected function updateSQL($id, $valueOne,$valueTwo,$valueThree,$valueFour,$valueFive,$valueSix, $valueSeven,$valueEight){ //There must be a better to update things. IF you only want to update one field needing to type in the other stuff feels like poor programming?
            $sql = "INSERT INTO Artist (artist_id, artist_fullName, artist_lastName , artist_born , artist_died , artist_origin , artist_influence , artist_desc )
            VALUES ('$valueOne','$valueTwo','$valueThree','$valueFour','$valueFive','$valueSix','$valueSeven','$valueEight')
            WHERE artist_id=$id";
            return $sql;
        }
        protected function deleteSQL($value){
            $sql = "DELETE FROM artist WHERE artist_id=$value";
            return $sql;
        }

        static function getAllArtist(){
            $sql = "SELECT *
            FROM artist";
            $results = $pdo ->query($sql);
            $arrayValues=array();
            while($row = $results->fetch()){
              $arrayValues[$row["artist_id"]] =$row["artist_fullName"];
            }
            return $arrayValues;
        }

        public function getData($id){        
            $sql = "SELECT *
            FROM artist
            where artist_id = $id";
            
            $results = $pdo ->query($sql);
            while($row = $results->fetch()){
               return $row;
            }
        }
        public function modifiedInformaiton(){
            foreach($this->changedFlag as $flag=>$bool){
                if($bool){
                    return true;
                }
            }
            return false;
        }
        public function toHTML(){ //pg. 1118    sanders-assignment4-40:59
            $theValues = array($this->getartistID(),$this->getFirstName(),$this->getLastName(),$this->getInfluence(),$this->getDateOfDeath(),$this->getDescription(),$this->getDateOfBirth(),$this->getOrigin() );
            $printOut = "<ul>";
            foreach($theValues as $value){
                $printOut .= "<li>". $value . "</li>";
            }
            $printOut .="</ul>";
            
            return $printOut;
        }
        public function setFirstName($artistID){
            $this->artistID = $artistID;
            $this->changedFlag['artistID'] = true;
        }
        public function setFirstName($firstName){
            $this->firstName = $firstName;
            $this->changedFlag['firstName'] = true;
        }
        public function setLastName($lastName){
            $this->lastName = $lastName;
            $this->changedFlag['lastName'] = true;
        }
        public function setOrigin($origin){
            $this->origin = $origin;
            $this->changedFlag['origin'] = true;
        }
        public function setInfluence($influence){
            $this->influence = $influence;
            $this->changedFlag['influence'] = true;
        }
        public function setDateOfDeath($dateOfDeath){
            $this->dateOfDeath = $dateOfDeath;
            $this->changedFlag['dateOfDeath'] = true;
        }
        public function setDescription($description){
            $this->description = $description;
            $this->changedFlag['description'] = true;
        }
        public function setDateOfBirth($DateOfBirth){
            $this->DateOfBirth = $DateOfBirth;
            $this->changedFlag['DateOfBirth'] = true;
        }
        public function getartistID(){
            return $this->artistID;
        }
        public function getFirstName(){
            return $this->firstName;
        }
        public function getLastName(){
            return $this->lastName;
        }
        public function getOrigin(){
            return $this->Origin;
        }
        public function getInfluence(){
            return $this->influence;
        }
        public function getDateOfDeath(){
            return $this->dateOfDeath;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getDateOfBirth(){
            return $this->DateOfBirth;
        }
    }
?>