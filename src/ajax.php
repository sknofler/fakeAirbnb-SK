<?php
/* PHP code for AJAX interaction goes here */


function getNeighborhood($db){
    $neighborhood = $_GET["nid"];
    $neighborhood= explode(',',$neighborhood);
    return $neighborhood;
}

function getRoomType($db){
    $roomType = $_GET["roomType"];
    $roomType= explode(',',$roomType);
    return $roomType;
}

function getListings($db){
    $neighborhood = getNeighborhood($db)[1];
    $nId = getNeighborhood($db)[0];
    $roomType = getRoomType($db)[1];
    $rId = getRoomType($db)[0];

    $string = "select pictureUrl, name, price, type, rating, neighborhood, accommodates 
    from listings join roomTypes on listings.roomTypeId = roomTypes.id 
    join neighborhoods on listings.neighborhoodId = neighborhoods.id ";
    if($neighborhood != "Any" && $roomType != "Any"){
        $string .= " where neighborhoodId ='$nId' and roomTypes.id = '$rId'";
    }
    else if($neighborhood == "Any" && $roomType != "Any"){
        $string .= " where roomTypes.id = '$rId'";
    }
    else if($neighborhood != "Any" && $roomType == "Any"){
        $string .= " where neighborhoodId ='$nId'";
    }
    $string .= " limit 20";
    //var_dump($string);
    try {
        $stmt = $db->prepare("$string");  
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($rows);
    }
    catch (Exception $e) {
        echo $e;
    }
    return $rows;
}


?>
