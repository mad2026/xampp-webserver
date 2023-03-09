<?php
function echoError($errMsg,$jsFile,$cssFile){
    require_once('echoHTMLtext.php');
    echoHead($jsFile, $cssFile);
    echoHeader("Error: Please go back and retry");
    echo "<h3>$errMsg </h3>";
    echoFooter();
}//echoError
?>