<?php
define('DEBUG_MODE', true);

#different credentials for live vs local site (allows you to upload site on web)
if( $_SERVER['HTTP_HOST'] == 'localhost'){
    
$host= 'localhost';
$dbname= 'hidden_gems';
$user = 'hidden_aric';
$password ='SFzzP(OMH/PFS]_e';



}else{

    $host= 'localhost';
    $dbname= 'u379996710_hidden_gems';
    $user = 'u379996710_hidden_aric';
    $password ='2E]O;#v]7C';

}



$DB = new PDO(
"mysql:host=$host;dbname=$dbname;
cahrset=utf8mb4",$user, $password 
);
