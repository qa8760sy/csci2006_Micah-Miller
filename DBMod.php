<?php
abstract class DBMod{
$id="";

 function __construct($id = null){
     $this->id = $id;
 } 

function save(){
    if($this->id === null){
        insertSQL();
    }else{
       updateSQL(); 
    }
}
function delete(){
    if($this->id !== null) {
        deleteSQL();
    } 
}

 abstract protected function insertSQL();
 abstract protected function updateSQL();
 abstract protected function deleteSQL();
 
 abstract function getData($id);
 abstract function toHTML();
 abstract function modifiedInformaiton();
} 
?>