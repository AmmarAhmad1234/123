<?php
  include("connection.php");
  $delId = $_GET['id'];
  $deleteQuery = "DELETE  FROM pdo_products WHERE prodId = :delId";
  $deletePrepare= $conn->prepare($deleteQuery);
  $deletePrepare->bindParam(':delId',$delId, PDO::PARAM_INT);
  if($deletePrepare->execute()){
    header("Location:adminView.php");
  }

?>