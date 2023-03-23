<?php
function echoHead($jsFile, $cssFile)
    {
    echo '
    <!DOCTYPE html>
    <html>
        <head>
            <title>Survey</title>
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
                    <h1>Teacher Survey</h1>
                    <nav>
                        <ul class="menu">
                            <li>
                                <button>Survey</button>
                            </li>
                            
                            <li>
                                <button class="current">Account</button>
                                <ul class="submenu">
                                    <li>Login</li>
                                    <li><a href="landingPage.php">Survey</a></li>
                                    <li>Manage</li>
                                </ul>
                            </li>

                            <li>
                                <form action="mailto:mad2026@utulsa.edu">
                                    <button type="submit">Email Us</button>
                                </form>
                            </li>
                            
                            <li>
                                <button>Logout</button>
                            </li>
                        </ul>

                        <br>
                    </nav>
                </header>
                <br>
                ';
    }//echoHeader

function echoFooter()
    {
        date_default_timezone_set('America/Chicago');
        $currDate = date('l jS \of F Y h:i:s A');
        echo '
                <br>
                <footer>
                    '.$currDate.' &copy; Copyright by Mason Davenport.  
                </footer>
            </body>
        </html>
        ';
    }//echoFooter