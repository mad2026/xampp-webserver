<?php
function echoHead($jsFile, $cssFile)
    {
    echo '
    <!DOCTYPE html>
    <html>
        <head>
            <title>Product Discount Calculator</title>
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
        $currYear = date('Y');
        echo '
                <br>
                <footer>
                    &copy; Mason Davenport, '.$currYear.'. Please contact <a href="mailto:mad2026@utulsa.edu">Admin</a> for more information.
                    <button onclick="history.back()">Go Back</button>   
                </footer>
            </body>
        </html>
        ';
    }//echoFooter