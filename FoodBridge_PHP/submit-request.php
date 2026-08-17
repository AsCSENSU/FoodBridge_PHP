<?php
session_start();
include("config.php");

$listing_id = $_GET['id'];

$sql = "SELECT * FROM FOOD_LISTING
        WHERE listing_ID='$listing_id'";

$result = mysqli_query($conn, $sql);

$food = mysqli_fetch_assoc($result);

if (!$food)
{
    die("Food listing not found.");
}

if (date("Y-m-d H:i:s") > $food['expiry_time'])
{
    die("This food has expired. Request is not allowed.");
}

if($_SESSION['role']!="NGO" &&
   $_SESSION['role']!="Recipient")
{
    die("Access Denied");
}

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location: food-listings.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM FOOD_LISTING WHERE listing_ID='$id'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
    die("Food not found.");
}

$row = mysqli_fetch_assoc($result);

if(isset($_POST['request_food']))
{
    $quantity = $_POST['quantity'];

    $listing_id = $row['listing_ID'];

    $requester_id = $_SESSION['user_id'];

    $today = date("Y-m-d H:i:s");

    $insert = "INSERT INTO REQUEST
    (
        listing_id,
        requester_id,
        requested_quantity,
        request_status,
        requested_at
    )

    VALUES
    (
        '$listing_id',
        '$requester_id',
        '$quantity',
        'Pending',
        '$today'
    )";

    if(mysqli_query($conn,$insert))
    {
        header("Location: request-food.php?success=1");
        exit();
    }
    else
    {
        $error = "Request Failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Request Food</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>

<i class="bi bi-envelope-fill"></i>

Request Food

</h3>

</div>

<div class="card-body">

<h4 class="text-success">

<?php echo $row['Food_Name']; ?>

</h4>

<hr>

<p>

<strong>Available Quantity:</strong>

<?php echo $row['quantity']; ?>

<?php echo $row['unit']; ?>

</p>

<p>

<strong>Location:</strong>

<?php echo $row['location']; ?>

</p>

<p>

<strong>Expiry Time:</strong>

<?php echo date("d M Y h:i A",strtotime($row['expiry_time'])); ?>

</p>

<p>

<strong>Status:</strong>

<span class="badge bg-success">

<?php echo $row['status']; ?>

</span>

</p>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Quantity You Need

</label>

<input
type="number"
name="quantity"
class="form-control"
required>

</div>

<button
type="submit"
name="request_food"
class="btn btn-success">

<i class="bi bi-send-fill"></i>

Submit Request

</button>

<a href="food-listings.php"
class="btn btn-secondary">

Back

</a>

</form>

<?php
if(isset($error))
{
?>

<div class="alert alert-danger mt-3">

<?php echo $error; ?>

</div>

<?php
}
?>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>