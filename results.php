<?php  
include ('config/config.example.php');
include ('src/ajax.php');
include ("src/functions.php");
$db = dbConnect();

$listings = getListings($db);

$neighborhood = getNeighborhood($db)[1];
$roomType = getRoomType($db)[1];
$count = count($listings);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">


    <title>Fake Airbnb Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="images/house-heart-fill.svg">
    <link rel="mask-icon" href="images/house-heart-fill.svg" color="#000000">   
  </head>
  <body>
    
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">About</h4>
                <p class="text-muted">Fake Airbnb. Data c/o http://insideairbnb.com/get-the-data/</p>
                </div>
            </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <i class="bi bi-house-heart-fill my-2"></i>    
                <strong>Fake Airbnb</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
    </header>

    <main>



        <div class="container">

            <h1>Results (<?=$count ?>)</h1>
            <p><strong>Neighborhood: </strong> <?=$neighborhood ?> </p>
            <p><strong>Room Type: </strong> <?=$roomType ?> </p>
            <p><strong>Accommodates: </strong> <?=$_GET["numGuests"] ?> </p>
            
           <?php 
           if($count == 0){
            echo "<p>No listings available. </p>";
           }
           else{
            $array = getListings($db);

            foreach($array as $rows){
                $pic = $rows["pictureUrl"];
                $name = $rows["name"];
                $price = $rows["price"];
                $type = $rows["type"];
                $rating = $rows["rating"];
                $neighborhood = $rows["neighborhood"];
                $accom = $rows["accommodates"];
                
                
                ?>
                 <div class='col'>
                <div class='card shadow-sm'>
                    <img src="<?=$pic?>">
            
                    <div class='card-body'>
                        <h5 class='card-title'><?=$neighborhood?></h5>
                        <p class='card-text'><?=$name?><br><?=$type?></p>
                        <p class='card-text'>Accommodates <?=$accom?></p>
            
                        <p class='card-text align-bottom'>
                        <i class='bi bi-star-fill'></i><span class=''><?=$rating?></span>
                        </p>
            
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='btn-group'>
                                <button type='button' id='3301' class='btn btn-sm btn-outline-secondary viewListing' data-bs-toggle='modal' data-bs-target='#fakeAirbnbnModal'>View</button>
                
                            </div>
                            <small class='text-muted'>$<?=$price?></small>
            
                        </div>
                    </div>
                </div>
            <?php
            } 
           }
           ?>



            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        </div><!-- .container-->


    </main>

    <footer class="text-muted py-5">
        <div class="container">

            <p class="mb-1">CS 293, Spring 2024</p>
            <p class="mb-1">Lewis & Clark College</p>
        </div>
    </footer>
    <!-- modal-->
 
    <script src="js/script.js"></script>

  </body>
</html>



<?php ?>