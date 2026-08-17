<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM FOOD_LISTING
        WHERE listing_ID='$id'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

if(
$_SESSION['role']!="Admin"
&&
$row['donor_id']!=$_SESSION['user_id']
)
{
die("Access Denied");
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
if(isset($_POST['update']))
{
    $food_name = $_POST['food_name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $location = $_POST['location'];
    $expiry_time = $_POST['expiry_time'];
    $status = $_POST['status'];

    $sql = "UPDATE FOOD_LISTING SET

    Food_Name='$food_name',
    description='$description',
    quantity='$quantity',
    unit='$unit',
    location='$location',
    expiry_time='$expiry_time',
    status='$status',
    updated_at=NOW()

    WHERE listing_ID='$id'";

try
{
    if(mysqli_query($conn, $sql))
    {
        header("Location: food-listings.php");
        exit();
    }
}
catch(mysqli_sql_exception $e)
{
    echo "<div style='
        margin:50px auto;
        max-width:600px;
        padding:25px;
        background:#f8d7da;
        color:#842029;
        border:1px solid #f5c2c7;
        border-radius:12px;
        font-family:Arial;
        text-align:center;
    '>";

    echo "<h3>Update Failed</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";

    echo "<a href='food-listings.php'
        style='
        display:inline-block;
        padding:10px 20px;
        background:#198754;
        color:white;
        text-decoration:none;
        border-radius:25px;
        '>
        Back to Food Listings
    </a>";

    echo "</div>";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Food</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>

<i class="bi bi-pencil-square"></i>

Edit Food Listing

</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">Food Name</label>

<input
type="text"
name="food_name"
class="form-control"
value="<?php echo $row['Food_Name']; ?>">

</div>

<div class="mb-3">

<label class="form-label">Description</label>

<textarea
name="description"
class="form-control"
rows="3"><?php echo $row['description']; ?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<label class="form-label">Quantity</label>

<input
type="number"
name="quantity"
class="form-control"
value="<?php echo $row['quantity']; ?>">

</div>

<div class="col-md-6">

<label class="form-label">Unit</label>

<input
type="text"
name="unit"
class="form-control"
value="<?php echo $row['unit']; ?>">

</div>

</div>

<br>

<div class="mb-3">

<label class="form-label">Location</label>

<input
type="text"
name="location"
class="form-control"
value="<?php echo $row['location']; ?>">

</div>

<div class="mb-3">

<label class="form-label">Expiry Time</label>

<input
type="datetime-local"
name="expiry_time"
class="form-control"
value="<?php echo date('Y-m-d\TH:i', strtotime($row['expiry_time'])); ?>">

</div>

<div class="mb-3">

<label class="form-label">Status</label>

<select name="status" class="form-select">

<option <?php if($row['status']=="Available") echo "selected"; ?>>Available</option>

<option <?php if($row['status']=="Requested") echo "selected"; ?>>Requested</option>

<option <?php if($row['status']=="Collected") echo "selected"; ?>>Collected</option>

<option <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-warning">

Update Food

</button>

<a
href="food-listings.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>