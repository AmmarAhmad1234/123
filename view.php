<?php

    require "connection.php";
    $viewQuery = "SELECT * FROM pdo_products";
    $viewprepare = $conn->prepare($viewQuery);
    $viewprepare -> execute();
    $viewData = $viewprepare->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($viewData);




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container">
        <div class="row g-4">
    <?php
    foreach($viewData as $e)
    {

?>
       
    <div class="card mx-3" style="width: 18rem;">
  <img src="images/<?= $e ['prodImage']?>" class="card-img-top" alt="...">
  <div class="card-body">
     <h5 class="card-title"><?= $e['prodName'] ?></h5>
    <p class="card-text">Price: <?= $e['prodPrice'] ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Description: <?= $e['prodDesc'] ?></li>
    <li class="list-group-item">Rating: <?= $e['prodRating'] ?></li>
  </ul>

</div>


<?php
    }
?>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
