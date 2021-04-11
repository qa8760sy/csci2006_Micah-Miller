<?php
/*
Represents the results of a validation
*/
class ValidationResult {
private $value; // user input value to be validated
private $cssClassName; // css class name for display
private $errorMessage; // error message to be displayed
private $isValid = true; // was the value valid

// constructor
public function __construct($cssClassName, $value, $errorMessage,$isValid) {
$this->cssClassName = $cssClassName;
$this->value = $value;
$this->errorMessage = $errorMessage;
$this->isValid = $isValid;
}

// accessors
public function getCssClassName(){
    return $this->cssClassName; 
}
public function getValue(){
    return $this->value;
}
public function getErrorMessage(){
    return $this->errorMessage;
}
public function isValid() {
    return $this->isValid;
}

/*
Static method used to check a querystring parameter
and return a ValidationResult
*/

static public function checkParameter($queryName, $pattern,$errMsg) {
    $error = "";
    $errClass = "";
    $value = "";
    $isValid = true;
// first check if the parameter doesn't exist or is empty
    if (empty($_POST[$queryName])) {
        $error = $errMsg;
        $errClass = "error";
        $isValid = false;
    }else{
// now compare it against a regular expression
        $value = $_POST[$queryName];
        if ( ! preg_match($pattern, $value) ) {
            $error = $errMsg;
            $errClass = "error";
            $isValid = false;
        }
    }
    return new ValidationResult($errClass, $value, $error, $isValid);
}
}
?>

<?php

// turn on error reporting to help potential debugging
// error_reporting(E_ALL);
// ini_set('display_errors','1');
// include_once('ValidationResult.class.php');
// // create default validation results
// $emailValid = new ValidationResult("", "", "", true);
// $passValid = new ValidationResult("", "", "", true);
// $countryValid = new ValidationResult("", "", "", true);
// // if GET then just display form
// //
// // if POST then user has submitted data, we need to validate it
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $emailValid = ValidationResult::checkParameter("email",
//     '/(.+)@([^\.].*)\.([a-z]{2,})/',
//     'Enter a valid email [PHP]');
//     $passValid = ValidationResult::checkParameter("password",
//     '/^[a-zA-Z]\w{8,16}$/',
//     'Enter a password between 8-16 characters [PHP]');
//     $countryValid = ValidationResult::checkParameter("country",
//     '/[1-4]/', 'Choose a country [PHP]');
// // if no validation errors redirect to another page
//     if ($emailValid->isValid() && $passValid->isValid() &&
//     $countryValid->isValid() ) {
//     header( 'Location: success.php' );
//     }
// }
?>
