<?php
require_once ('../app_config.php');
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/echoHTMLText.php'); 
require_once (APP_ROOT . APP_FOLDER_NAME . '/scripts/errorDisplay.php');

function dbEstablish($teacherName, $teacherComment, $teacherEMail)
{
    try {
        $myDB = new PDO(DSN1, USER1, PASSWD1);
        $myDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echoError("Connection failed: " . $e->getMessage(), APP_FOLDER_NAME . '/clientScripts/teacherSurvey.js', APP_FOLDER_NAME . '/styles/teacherSurvey.css');
    }
    
    $selectStmt = "SELECT T.teacherName, T.teacherComment, T.teacherEMail FROM myteachers AS T";
    try {
        $stmt = $myDB -> prepare ($selectStmt);
        $stmt ->execute();
        $allTeachers = $stmt->fetchAll();
        $stmt -> closeCursor();
        //DEBUG print_r($allTeachers); exit(1);
    } catch (Exception $e) {
        echoError ($e-> getMessage(), APP_FOLDER_NAME . '/clientScripts/teacherSurvey.js', APP_FOLDER_NAME . '/styles/teacherSurvey.css');
        exit(1);
    }//catch 

    try {
        $pdo = new PDO(DSN1, USER1, PASSWD1);
        $stmt = $pdo->prepare("INSERT INTO myTeachers(teacherName, teacherComment, teacherEMail) VALUES (?, ?, ?)");
        $stmt->execute([$teacherName, $teacherComment, $teacherEMail]);
        //echo "Record inserted successfully";
    } catch(PDOException $e) {
        echoError("Insert failed: " . $e->getMessage(), APP_FOLDER_NAME . '/clientScripts/customerRegistration.js', APP_FOLDER_NAME . '/styles/customerRegistration.css');
        exit(1);
    }

    return $pdo;
}

#echo "hi";
#dbEstablish("bob","test comment","job@example.example");
?>
