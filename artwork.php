<?php 
require_once "DBMod.php";
class Artwork extends DBMod{

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
    // artists(fk), name, locaiton(fk), reprint price, description,                  (arrays)  genre, subject
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
                    'points' => 'points: 200',
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
            // $theValues = array($this->getGame(),$this->getPoints(),$this->getHost(),$this->getHostFaction(),$this->getPlayer(),$this->getPlayerFaction(),$this->getMap(),$this->getLengthOfGame(), );
            // $printOut = "<ul>";
            // foreach($theValues as $value){
            //     $printOut .= "<li>". $value . "</li>";
            // }
            // $printOut .="</ul>";
            
            // return $printOut;
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
