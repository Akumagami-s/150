<?php

require 'function.php';


session_start();



    if (isset($_POST)) {
        $query = addcart($_SESSION['user'][0]['id'],$_POST['productid']);
        
    }

?>