<?php

    require  "connection.php";
    $upId = $_GET['id'];
    $viewQuery = "SELECT * FROM pdo_products WHERE prodId = :upId";
    $viewprepare = $conn->prepare($viewQuery);
    $viewprepare->bindParam(':upId',$upId, PDO::PARAM_INT);
    $viewprepare->execute();
    $viewData = $viewprepare->fetchAll(PDO::FETCH_ASSOC);

    $viewData = $viewData[0];

    
    
    if (isset($_POST["btn"])){
        $prodName = $_POST ['prodName'];
        $prodPrice = $_POST ['prodPrice'];
        $prodDesc = $_POST ['prodDesc'];
        $prodRating = $_POST ['prodRating'];
        $prodImage = $_FILES['prodImage'];

        echo '<pre>';
        print_r($prodImage);
        echo '</pre>';
        
        
        if($prodImage['size'] > 5000000){
            echo "<script>alert('your image is to big')</script>";
        }
        else{
            $extension = explode(".", $prodImage['name']);
            // print_r($extension);
            $extension = $extension[1];
            $imageUniqueName = uniqid();
            $imageName = $imageUniqueName . '.' . $extension;
            print_r($imageName);
            move_uploaded_file($prodImage["tmp_name"], "images/".$imageName);
            // $img =empty($prodImage['name']) ? $viewData['prodImage'] : $imageName;
            // $img = empty($prodImage['name']) ? $viewData['prodImage'] : $imageName;

            $img =empty($prodImage['name']) ? $viewData['prodImage'] : $imageName;
        
        
        $upQuery = "UPDATE pdo_products SET  prodName= :prodName, prodPrice= :prodPrice, prodDesc= :prodDesc, prodRating= :prodRating, prodImage= :prodImage WHERE prodId= :prodId";
        
        $insertPrepare  = $conn->prepare($upQuery);
        
            $insertPrepare ->bindParam(":prodId", $upId, PDO::PARAM_STR);
            $insertPrepare ->bindParam(":prodName", $prodName, PDO::PARAM_STR);
            $insertPrepare ->bindParam(":prodPrice", $prodPrice, PDO::PARAM_STR);
            $insertPrepare ->bindParam(":prodDesc", $prodDesc, PDO::PARAM_STR);
            $insertPrepare ->bindParam(":prodRating", $prodRating);
            $insertPrepare ->bindParam(":prodImage", $img, PDO::PARAM_STR);

         
        if($insertPrepare ->execute()){
            echo "<script>alert('Your Data Insert Succefully')</script>";
            header("location:adminView.php");
        }
        else{
            echo "Your Data Insert failed";
        }
            
            


        }
    }

?>





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDO CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">User Registration Form!</h1>
    <div class="container">
        <div class="row">
            <form class="row g-3" method="post" enctype="multipart/form-data" style="display: flex; justify-content:center">
                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">PRODUCT NAME</label>
                    <input type="text" class="form-control" name="prodName" value="<?=$viewData['prodName'] ?>">
                </div>
                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">PRODUCT PRICE</label>
                    <input type="text" class="form-control" name="prodPrice" value="<?=$viewData['prodPrice'] ?>">
                </div>
                <div class="col-md-8">
                    <label for="inputPassword4" class="form-label">PRODUCT DESC</label>
                    <input type="text" class="form-control" name="prodDesc" value="<?=$viewData['prodDesc'] ?>">
                </div>
                <div class="col-md-8">
                    <label for="inputCity" class="form-label">PRODUCT RATING</label>
                    <input type="text" class="form-control" name="prodRating" value="<?=$viewData['prodRating'] ?>">
                </div>
                <div class="col-md-8">
                    <img src="images/<?=$viewData['prodImage']?>" alt="" width="100">
                    <label for="inputCity" class="form-label">PRODUCT IMAGE</label>
                    <input type="file" class="form-control" name="prodImage" accept="images/png,images/jpg,images/jpeg">
                </div>
                <div class="col-8">
                    <button type="submit" class="btn btn-primary" name="btn">CLICK</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>