<?php 
//application folder name on your web root or htdocs folder
define('APP_ROOT',$_SERVER['DOCUMENT_ROOT']);
//DEBUG echo (APP_ROOT);
define('APP_FOLDER_NAME', '/CIS4033/inClassDB1');
define('WEB_ROOT','http://'.$_SERVER['SERVER_NAME']);
define('DSN1', 'mysql:host=localhost; dbname=MasonDavenportProg3CustomerInfo');
define('USER1', 'kermit');
define('PASSWD1', 'sesame')
//DEBUG echo(WEB_ROOT);
?>