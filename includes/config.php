<?php
define('DEBUG_MODE', true);

$host= 'localhost';
$dbname= 'hidden_gems';
$user = 'hidden_aric';
$password ='SFzzP(OMH/PFS]_e';

$DB = new PDO(
"mysql:host=$host;dbname=$dbname;
cahrset=utf8mb4",$user, $password 
);
