<?php
require_once('echoHTMLtext.php');
echoHead("../clientScripts/teacherSurvey.js", "../styles/teacherSurvey.css");
echoHeader("Teacher Survey");
echo '<main>    
        <form action="teacherFillsSurvey.php" name="teacherSurvey" id="teacherSurvey" method="post">
            <fieldset> 
                <legend>Survey Information</legend>
                <label>teacher Name:</label>
                <input type="text" name="teacherName" id="teacherName" minlength="2" required><br>
                
                <label>teacher Comment:</label>
                <input type="text" name="teacherComment" id="teacherComment" minlength="20" placeholder="Provide a Comment at least 20 characters long" required><br>
                
                <label>teacher Email:</label>
                <input type="email" name="teacherEMail" id="teacherEMail" placeholder="example@example.com" required><br>
                </fieldset>
            <br>
            <fieldset>
                <legend>Submit Your Survey</legend>
                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" id="submit" value="Submit">
                    <input type="reset" id="reset"  value="Reset Fields"><br>
                </div>
            </fieldset>
        </form>
    </main>';
echoFooter();
