<?php
session_start();

if(isset($_SESSION['user_id']))
{
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBridge</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">

            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-basket2-fill"></i> FoodBridge
            </a>

            <div class="ms-auto">
                <a href="index.php" class="btn btn-success text-white">Home</a>
                <a href="login.php" class="btn btn-outline-light">Login</a>
                <a href="register.php" class="btn btn-light text-success">Register</a>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <!-- <section class="hero">
    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Share Food, Share Hope
        </h1>

        <p class="lead mt-3">
            FoodBridge connects restaurants, cafeterias, individual donors,
            NGOs and recipients to reduce food waste and help communities.
        </p>

        <a href="login.php" class="btn btn-success btn-lg mt-3">
            Donate Food
        </a>

        <a href="login.php" class="btn btn-outline-success btn-lg mt-3">
            Request Food
        </a>
    </div>
    </section> -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <!-- Left side: text -->

            <div class="col-md-6 text-center">

                <h1 class="display-4 fw-bold">
                    Share Food, Share Hope
                </h1>

                <p class="lead mt-3">
                    FoodBridge connects restaurants, cafeterias, individual donors,
                    NGOs and recipients to reduce food waste and help communities.
                </p>

                <a href="login.php" class="btn btn-success btn-lg mt-3 me-2">
                    Donate Food
                </a>

                <a href="login.php" class="btn btn-outline-success btn-lg mt-3">
                    Request Food
                </a>

            </div>

            <!-- Right side: image -->

            <div class="col-md-6 text-center">

                <img src="images/food-share.png"
                     class="img-fluid rounded shadow"
                     alt="Food donation image"
                     width="500">

            </div>

        </div>

    </div>

</section>


    <section class="container py-5">

    <div class="row align-items-center">

        <div class="col-lg-6 text-center">

            <h2 class="fw-bold text-success">
                About FoodBridge
            </h2>

            <p class="mt-3">
                FoodBridge is a surplus food sharing platform that connects restaurants,
                cafeterias and individual donors with NGOs and recipients to reduce food
                waste and support communities.
            </p>

        </div>

        <div class="col-lg-6 text-center ps-5">

            <i class="bi bi-basket2-fill text-success"
               style="font-size:140px;"></i>

        </div>

    </div>

    </section>
    <section class="container py-5">

<h2 class="text-center fw-bold text-success mb-5">
Core Features
</h2>

<div class="row">

<div class="col-md-4">

<div class="card shadow border-0 p-4 text-center">

<i class="bi bi-box-seam text-success"
style="font-size:50px;"></i>

<h4 class="mt-3">
Food Listings
</h4>

<p>
Donors can post surplus food with quantity,
location and expiry time.
</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow border-0 p-4 text-center">

<i class="bi bi-hand-index-thumb text-success"
style="font-size:50px;"></i>

<h4 class="mt-3">
Request Food
</h4>

<p>
NGOs and recipients can browse listings
and submit food requests.
</p>

</div>

</div>

<div class="col-md-4">

<div class="card shadow border-0 p-4 text-center">

<i class="bi bi-clock-history text-success"
style="font-size:50px;"></i>

<h4 class="mt-3">
Donation History
</h4>

<p>
Track completed food donations and maintain
a history of distributions.
</p>

</div>

</div>

</div>

</section>

<section class="bg-success text-white py-5">

<div class="container">

<div class="row text-center">

<div class="col-md-3">

<h2>250+</h2>

<p>Food Donations</p>

</div>

<div class="col-md-3">

<h2>40+</h2>

<p>Partner NGOs</p>

</div>

<div class="col-md-3">

<h2>500+</h2>

<p>Families Helped</p>

</div>

<div class="col-md-3">

<h2>100%</h2>

<p>Community Support</p>

</div>

</div>

</div>

</section>

<footer class="bg-dark text-white text-center p-3">

© 2026 FoodBridge | CSE311L Database Systems Lab Project

</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>