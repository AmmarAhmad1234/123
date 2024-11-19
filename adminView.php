<?php

require "connection.php";
$viewQuery = "SELECT * FROM pdo_products";
$viewprepare = $conn->prepare($viewQuery);
$viewprepare->execute();
$viewData = $viewprepare ->fetchAll(PDO::FETCH_ASSOC);

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
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Price</th>
      <th scope="col">Product Description</th>
      <th scope="col">Product Rating</th>
      <th scope="col">Product Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php

    foreach ($viewData as $e){
?>
    <tr>
      <td><?= $e ['prodId']?></td>
      <td><?= $e ['prodName']?></td>
      <td><?= $e ['prodPrice']?></td>
      <td><?= $e ['prodDesc']?></td>
      <td><?= $e ['prodRating']?></td>
      <td><img src="images/<?= $e ['prodImage']?>" alt="" width="100"></td>
      <td>
        <a class="btn btn-warning" href="update.php?id=<?= $e ['prodId']?>">Update</a> 
      <a  class="btn btn-danger"  href="delete.php?id=<?=$e['prodId']?>">Delete</a>
      </td>
      
    </tr>
    <?php
      }
    ?>
  </tbody>

</table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
