<?php

/* Add your functions here */


function dbConnect(){
    /* defined in config/config.php */
    /*** connection credentials *******/
    /*$servername = SERVER;
    $username = USERNAME;
    $password = PASSWORD;
    $database = DATABASE;
    $dbport = PORT;*/
    $servername = "localhost";
    $username = "fakeAirbnbUser";
    $password = "apples11Million!";
    $database = "fakeAirbnb";
    $dbport = 3306;
    /****** connect to database **************/

    try {
        $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4;port=$dbport", $username, $password);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $db;
}

function getNeighborhoods($db){
    try {
        $stmt = $db->prepare("select * from neighborhoods order by neighborhood asc");  
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        echo $e;
    }
    return $rows;
}

function getRoomTypes($db){
    try {
        $stmt = $db->prepare("select id, type from roomTypes");  
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        echo $e;
    }
    return $rows;
}

function getNumberOfGuests(){}

?>