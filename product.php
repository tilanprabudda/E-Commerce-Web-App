<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Pizza Corner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>

 <?php
include 'inculed/header.php';
?>

<div class="container" style="margin-top:100px">

        <div class="jumbotron text-center">
            <h1>Welcome to Pizza Corner</h1>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pizza</li>
            </ol>
        </nav>

    <hr/>

    <div class="row text-center" id="pizzar">
        <div class="col-md-3 col-6 py-2">
            <div class="card">
                <img src="images\pizza.png" alt="" class="img-fluid pb-1" >
                <div class="figure-caption">
                    <h6>Regular Pizza</h6>
                    <h6>Price :Rs 3000</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                    <p><a href="*****" role="button" class="btn btn-warning  text-white ">Add To Cart</a></p>
                    <?php
                    } else {
                    if (check_if(1)) {
                     echo '<p><a href="#" class="btn btn-warning  text-white" disabled>Added to cart</a></p>';
                    } else {
                        ?>
                        <p><a href="cart-add.php?id=1" name="add" value="add" class="btn btn-warning  text-white">Add to cart</a><p>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        </div>




</body>