<?php
//APP_ROOT.APP_FOLDER_NAME.
require_once("../app_config.php");
require_once(APP_ROOT.APP_FOLDER_NAME."/scripts/echoHTMLtext.php");
//echo date('Y');
echoHead(APP_ROOT.APP_FOLDER_NAME."/clientScripts/validateForm.js", APP_ROOT.APP_FOLDER_NAME."/styles/customerRegistration.css", "Register");
echoHeader("Register Yourself");
echo '



            <form action="'.WEB_ROOT.APP_FOLDER_NAME.'/scripts/registerCustomer.php" onsubmit="return productValidate();" method="post">
                <div id="data">  
                    <label>Name:</label>
                    <input type="text" name="customer_name" id="customer_name" pattern=".{2,}"/>
                    <br />

                    <label>Email Address:</label>
                    <input type="email" name="customer_email" id="customer_email"/>
                    <br />

                    <label>Re-Enter Email Address:</label>
                    <input type="email" name="customer_email2" id="customer_email2"/>
                    <br />

                    <label>Password:</label>
                    <input type="password" name="customer_password1" id="customer_password1" pattern =".{6,}"/>
                    <br />

                    <label>Verify Password:</label>
                    <input type="password" name="customer_password2" id="customer_password2" pattern =".{6,}"/>
                    <br />
                </div>

                <div id="buttons">
                        <label>&nbsp;</label>
                        <input type="submit" id="submit" value="Submit Information"/>
                        <input type="reset" id="reset_list" name="reset_list"/>
                        <br />
                </div>
            </form>
        ';
echoFooter();


?>