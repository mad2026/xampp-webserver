<?php
function echoHead($jsFile, $cssFile)
    {
    echo '
    <!DOCTYPE html>
    <html>
        <head>
            <title>Register</title>
            <link rel="stylesheet" type="text/css" href="'.$cssFile.'">
            <script src="'.$jsFile.'"></script>
        </head>
        ';
    }//echoHead
function echoHeader($title)
    {
    echo '
            <body>
                <header>
                <h2>'.$title.'</h2>
                <img src="../Custom_Images/Logo_de_Enron.svg.png" height="40px" width="40px" /><br>
                </header>
                <br>
                ';
    }//echoHeader

function echoFooter()
    {
        $currDate = date('l jS \of F Y h:i:s A');
        echo '
                <br>
                <footer>
                    &copy; Mason Davenport, '.$currDate.'. C Copyright by Mason Davenport.  
                </footer>
            </body>
        </html>
        ';
    }//echoFooter