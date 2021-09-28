<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');


require 'DB.php';
require 'ModelNumber.php';

$db = new ModelNumber(DB::getConnection());

if(isset($_POST['number'])){

    if($db->checkCache($_POST['number'])) die($db->getDate($_POST['number']));

    print_r($db->create($_POST['number']));

}