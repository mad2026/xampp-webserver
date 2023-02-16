<?php
function echoHeader($title)
    {
    echo '
        <h2>Discount Information</h2>
        <img src="../Custom_Images/Logo_de_Enron.svg.png" height="40px" width="40px" /><br>
        ';
    }//echoHeader

function echoFooter()
    {
        $currYear = date('Y');
        echo '
        <footer>
            &copy; Mason Davenport, '.$currYear.'. Please contact <a href="mailto:mad2026@utulsa.edu">Admin</a> for more information.
            <button onclick="history.back()">Go Back</button>   
        </footer>
        ';
    }//echoFooter