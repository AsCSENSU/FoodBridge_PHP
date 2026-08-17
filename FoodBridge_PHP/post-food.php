<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

// if($_SESSION['role']!="Donor" && $_SESSION['role']!="Admin")
// {
//     die("Access Denied");
// }
if ($_SESSION['role']!="Donor" && $_SESSION['role']!="Admin")
{
?>

<!DOCTYPE html>
<html>

<head>

    <title>Access Denied</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow border-danger">

        <div class="card-header bg-danger text-white">

            <h3>Access Denied</h3>

        </div>

        <div class="card-body text-center">

            <h4>You are not authorized to access this page!</h4>

            <p class="text-muted">
                Please go back to your dashboard.
            </p>

            <a href="dashboard.php" class="btn btn-success">
                Back to Dashboard
            </a>

        </div>

    </div>

</div>

</body>

</html>

<?php
exit();
}

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['post_food']))
{
    $donor_id = $_SESSION['user_id'];
    $food_name = $_POST['food_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $location = $_POST['location'];
    $expiry_time = $_POST['expiry_time'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $sql = "INSERT INTO FOOD_LISTING
    (donor_id, food_name, description, quantity, unit, location, expiry_time, status, created_at)
    VALUES
    ('$donor_id','$food_name','$description','$quantity','$unit','$location','$expiry_time','$status',NOW())";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
                alert('Food posted successfully!');
                window.location='food-listings.php';
              </script>";
    }
    else
    {
        echo "<script>alert('Failed to post food!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Post Food - FoodBridge</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container-fluid">

<div class="row">

<!-- Sidebar -->

<div class="col-md-3 col-lg-2 sidebar p-4">

<h3 class="text-white mb-4 sidebar-title">
    <i class="bi bi-basket2-fill"></i> FoodBridge
</h3>

<a href="dashboard.php">
<i class="bi bi-house-door-fill"></i>
Dashboard
</a>

<a href="food-listings.php">
<i class="bi bi-box-seam"></i>
Food Listings
</a>

<a href="post-food.php" class="active">
<i class="bi bi-plus-circle"></i>
Post Food
</a>

<a href="request-food.php">
<i class="bi bi-envelope"></i>
Requests
</a>

<a href="donation-history.php">
<i class="bi bi-clock-history"></i>
Donation History
</a>

                <a href="report.php">
                    <i class="bi bi-bar-chart-line"></i> Reports
                </a>

<a href="logout.php">
<i class="bi bi-box-arrow-right"></i>
Logout
</a>

</div>

<!-- Main Content -->

<div class="col-md-9 col-lg-10 p-4">

<h2 class="fw-bold">

<i class="bi bi-plus-circle-fill text-success"></i>

Post Food

</h2>

<p class="text-muted">

Fill in the information below to add a new food listing.

</p>

<div class="card shadow border-0 mt-4">

<div class="card-body p-4">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Food Name

</label>

<input
type="text"
name="food_name"
class="form-control"
placeholder="Enter food name"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Quantity

</label>

<input
type="number"
name="quantity"
class="form-control"
placeholder="Enter quantity"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Unit

</label>

<select
name="unit"
class="form-select"
required>

<option selected disabled>

Select Unit

</option>

<option>Packs</option>

<option>Kg</option>

<option>Boxes</option>

<option>Plates</option>

<option>Cups</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Pickup Location

</label>

<input
type="text"
name="location"
class="form-control"
placeholder="Enter pickup location"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Expiry Time

</label>

<input
type="datetime-local"
name="expiry_time"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option>Available</option>

</select>

</div>

<div class="col-12 mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
class="form-control"
rows="4"
maxlength="200"
placeholder="Write a short description...">
</textarea>

<div class="form-text">

Maximum 200 characters.

</div>

</div>

<div class="col-12">

<button
type="submit"
name="post_food"
class="btn btn-success px-4">

<i class="bi bi-check-circle-fill"></i>

Post Food

</button>

<button
type="reset"
class="btn btn-outline-secondary px-4">

<i class="bi bi-arrow-counterclockwise"></i>

Reset

</button>

</div>

</div>


</form>

</div>

</div>

</div>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>