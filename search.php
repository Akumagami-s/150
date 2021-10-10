<?php

require 'function.php';


session_start();

    if (isset($_GET)) {
        global $conn;
        $query =query('SELECT * FROM product WHERE name LIKE "%'.$_GET['search'].'%"');
        echo json_encode($query);
        
        
    }

?>