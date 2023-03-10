<?php
//WEB_ROOT.APP_FOLDER_NAME.

function echoHead($jsFile, $cssFile, $title){
    require_once('../app_config.php');
    echo '
        <!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <title>'.$title.'</title>
            <link rel="stylesheet" type="text/css" href="'. $cssFile .'">
            <script src="'. $jsFile .'"></script>
            </head>

    ';
}
function echoHeader($caption){
    require_once('../app_config.php');
    echoMenu();
        echo '
            <body>
                <header class="center">
                          <h1>'.$caption.'</h1>
                </header>

           

                <main>
        ';//end echo
    }

    function echoFooter(){
        //$currYear = date("Y");
        require_once('../app_config.php');
        echo '
            </main>
                <footer class="center">
                </footer>
            </body>
            </html>
            <br />
        ';//end echo


    }
function echoMenu(){
    echo '
    <div class="topnav">
        <a class="active" href="'. WEB_ROOT.APP_FOLDER_NAME.'"/scripts/landingPage.php">Register</a>
        <a href="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/viewAll.php">View All</a>
    </div>

';
}
?>