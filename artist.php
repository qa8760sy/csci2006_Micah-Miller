<?php 
require_once "DBMod.php";
class artist extends DBMod{
    // game, points, Host, hostFaction, player, playerFaction, map, lengthOfGame
            private $game;
            private $points;
            private $host;
            private $hostFaciton;
            private $player;
            private $playerFaction;
            private $map;
            private $lengthOfGame;
            
            public $changedFlag = array( 
                'game' => false,
                'points' => false,
                'host' => false,
                'hostFaction' => false,
                'player' => false,
                'playerFaction' => false,
                'map' => false,
                'lengthOfGame' => false,
                );
    // full name, last name, char for influence, description, date of death, char for origin, Date of birth
        function __construct($intVariable = null){
            parent::__construct($intVariable);
            $constructorVariable  = $this->getData($intVariable);
            $this->game = $constructorVariable['game'];
            $this->points = $constructorVariable['points'];
            $this->host = $constructorVariable['host'];
            $this->hostFaction = $constructorVariable['hostFaction'];
            $this->player = $constructorVariable['player'];
            $this->playerFaction = $constructorVariable['playerFaction'];
            $this->map = $constructorVariable['map'];
            $this->lengthOfGame = $constructorVariable['lengthOfGame'];
        }
        
        protected function insertSQL(){

        }
        protected function updateSQL(){

        }
        protected function deleteSQL(){

        }

        public function getData($id){        
            switch ($id){
                case 1:
                return
                    ['game' => 'game: star wars miniatures',
                    'points' => 'points: 400',
                    'host' => 'host: myself',
                    'hostFaction' => 'Host Faction: imperial',
                    'player' => 'Player: cory',
                    'playerFaction' => 'Player Faction: rebs',
                    'map' => 'Map: bunker',
                    'lengthOfGame' => 'Number of Turns: 8',
                     ];
                break;
    
                case 2:
                return
                    ['game' => 'game: star wars miniatures',
                    'points' => 'points: 200',
                    'host' => 'host: me',
                    'hostFaction' => 'Host Faction: vong',
                    'player' => 'Player: cory',
                    'playerFaction' => 'Player Faction: new republic',
                    'map' => 'Map: endor',
                    'lengthOfGame' => 'Number of Turns: 7',
                    ];
                break;
    
                case 3:
                return
                    ['game' => 'game: Kill team',
                    'spoint' => 'points: 200',
                    'host' => 'host: meAgain',
                    'hostFaction' => 'Host Faction: eldar',
                    'player' => 'Player: justin',
                    'playerFaction' => 'Player Faction: nurgle',
                    'map' => 'Map: containers',
                    'lengthOfGame' => 'Number of Turns: 3',
                    ];
                break;
    
                default:
                return
                    ['game' => 'game: unkown',
                     'points' => 'points: 00',
                     'host' => 'host: unknown',
                     'hostFaction' => 'Host Faction: unknown',
                     'player' => 'Player: unknown',
                     'playerFaction' => 'Player Faction: unknown',
                     'map' => 'Map: unknown',
                     'lengthOfGame' => 'Number of Turns: 00',
                   ];
                break;
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
        public function toHTML(){ //pg. 1118
            $theValues = array($this->getGame(),$this->getPoints(),$this->getHost(),$this->getHostFaction(),$this->getPlayer(),$this->getPlayerFaction(),$this->getMap(),$this->getLengthOfGame(), );
            $printOut = "<ul>";
            foreach($theValues as $value){
                $printOut .= "<li>". $value . "</li>";
            }
            $printOut .="</ul>";
            
            return $printOut;
        }
        public function setGame($game){
            $this->game = $game;
            $this->changedFlag['game'] = true;
    
        }
        public function setPoints($points){
            $this->points = $points;
            $this->changedFlag['points'] = true;
        }
        public function setHost($host){
            $this->host = $host;
            $this->changedFlag['host'] = true;
        }
        public function setHostFaction($hostFaciton){
            $this->hostFaction = $hostFaction;
            $this->changedFlag['hostFaction'] = true;
        }
        public function setPlayer($player){
            $this->player = $player;
            $this->changedFlag['player'] = true;
        }
        public function setPlayerFaction($playerFaction){
            $this->playerFaction = $playerFaction;
            $this->changedFlag['playerFaction'] = true;
        }
        public function setMap($map){
            $this->map = $map;
            $this->changedFlag['map'] = true;
        }
        public function setLengthOfGame($lengthOfGame){
            $this->lengthOfGame = $lengthOfGame;
            $this->changedFlag['lengthOfGame'] = true;
        }
        public function getGame(){
            return $this->game;
        }
        public function getPoints(){
            return $this->points;
        }
        public function getHost(){
            return $this->host;
        }
        public function getHostFaction(){
            return $this->hostFaction;
        }
        public function getPlayer(){
            return $this->player;
        }
        public function getPlayerFaction(){
            return $this->playerFaction;
        }
        public function getMap(){
            return $this->map;
        }
        public function getLengthOfGame(){
            return $this->lengthOfGame;
        }
    
    
    }
    ?>