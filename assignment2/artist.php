<?php 
require_once "DBMod.php";
class artist extends DBMod{    
            private $artistID; 
            private $fullName;
            private $lastName;
            private $influence;
            private $dateOfDeath;
            private $description;
            private $DateOfBirth;
            private $origin;

        public $changedFlag = array( 
            'artistID' => false,
            'fullName' => false,
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
            $this->fullName = $constructorVariable['artist_fullName'];
            $this->lastName = $constructorVariable['artist_lastName'];
            $this->influence = $constructorVariable['artist_influence'];
            $this->dateOfDeath = $constructorVariable['artist_died'];
            $this->description = $constructorVariable['artist_desc'];
            $this->DateOfBirth = $constructorVariable['artist_born'];
            $this->origin = $constructorVariable['artist_origin'];
        }
        
        protected function insertSQL(){
            $sql = "INSERT INTO Artist (artist_id, artist_fullName, artist_lastName , artist_born , artist_died , artist_origin , artist_influence , artist_desc )
            VALUES ('$this->id','$this->fullName','$this->lastNmae','$this->DateOfBirth','$this->dateOfDeath','$this->origin','$this->influence', '$this->description')";
            return $sql;
        }

        protected function updateSQL(){ //There must be a better to update things. IF you only want to update one field needing to type in the other stuff feels like poor programming?
            $sql = "Update Artist Set
            artist_fullName = '$this->fullName',
            artist_lastName = '$this->lastNmae',
            artist_born = '$this->DateOfBirth',
            artist_died = '$this->dateOfDeath',
            artist_origin = '$this->origin',
            artist_influence = '$this->influence',
            artist_desc = '$this->description'
            WHERE artist_id=$this->id";
            return $sql;
        }
        
        protected function deleteSQL(){
            $sql = "DELETE FROM artist WHERE artist_id=$this->id";
            return $sql;
        }

        static function getAllArtist(){
            $pdo = connectToDb();
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
            $pdo = connectToDb();     
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
        public function toHTML(){ 
            
            $printout = <<<__html__
            <h2><b>{$this->getfullName()}</b></h2>
            <table><div class="leftSide" >
            <table>
            <caption>Some Basic Information</caption>
            <tr><td>Full Name:</td><td>{$this->getfullName()}</td></tr>
            <tr><td>Influence:</td><td>{$this->getInfluence()}</td></tr>
            <tr><td>origin:</td><td>{$this->getOrigin()}</td></tr>
            <tr><td>Date of brith:</td><td>{$this->getDateOfBirth()}</td></tr>
            <tr><td>Date of death:</td><td>{$this->getDateOfDeath()}</td></tr>
            </table></div><br>
            <div class="rightSide"><h3>Some background information</h3><br>{$this->getDescription()}</div> <br>
            __html__;
           
            return $printout;
        }
        public function setartistID($artistID){
            $this->artistID = $artistID;
            $this->changedFlag['artistID'] = true;
        }
        public function setfullName($fullName){
            $this->fullName = $fullName;
            $this->changedFlag['fullName'] = true;
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
        public function getfullName(){
            return htmlentities(utf8_encode($this->fullName));
        }
        public function getLastName(){
            return htmlentities(utf8_encode($this->lastName));
        }
        public function getOrigin(){
            return $this->origin;
        }
       public function getInfluence(){
           return $this->influence;
       }
       public function getDateOfDeath(){
           return $this->dateOfDeath;
       }
       public function getDescription(){
        //    return $this->description;
           return htmlentities(utf8_encode($this->description));
       }
       public function getDateOfBirth(){
           return $this->DateOfBirth;
       }
    }
?>