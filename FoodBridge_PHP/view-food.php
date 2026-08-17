<?php
session_start();
include("config.php");

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

// $sql = "SELECT * FROM FOOD_LISTING WHERE listing_ID='$id'";
// donor name
$sql = "SELECT FOOD_LISTING.*, User.full_name
        FROM FOOD_LISTING
        JOIN User
        ON FOOD_LISTING.donor_id = User.user_id
        WHERE FOOD_LISTING.listing_ID='$id'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)==0)
{
    die("Food listing not found.");
}

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Food</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>
<i class="bi bi-eye-fill"></i>
Food Details
</h3>

</div>

<div class="card-body">

<table class="table">

<tr>
<th>Food Name</th>
<td><?php echo $row['Food_Name']; ?></td>
</tr>

<tr>
    <th>Donor Name</th>
    <td><?php echo $row['full_name']; ?></td>
</tr>

<tr>
<th>Description</th>
<td><?php echo $row['description']; ?></td>
</tr>

<tr>
<th>Quantity</th>
<td><?php echo $row['quantity']." ".$row['unit']; ?></td>
</tr>

<tr>
<th>Location</th>
<td><?php echo $row['location']; ?></td>
</tr>

<tr>
<th>Expiry Time</th>
<td><?php echo date("d M Y h:i A", strtotime($row['expiry_time'])); ?></td>
</tr>

<tr>
<th>Status</th>

<td>

<?php

$status = $row['status'];

if($status == "Available")
{
    $badge = "success";
}
elseif($status == "Requested")
{
    $badge = "warning text-dark";
}
elseif($status == "Collected")
{
    $badge = "primary";
}
elseif($status == "Completed")
{
    $badge = "secondary";
}
elseif($status == "Expired")
{
    $badge = "danger";
}
else
{
    $badge = "dark";
}

?>

<span class="badge bg-<?php echo explode(" ", $badge)[0]; ?>
<?php if(str_contains($badge, "text-dark")) echo "text-dark"; ?>">

<?php echo $status; ?>

</span>

</td>

</tr>

<tr>
<th>Created At</th>
<td><?php echo date("d M Y h:i A", strtotime($row['created_at'])); ?></td>
</tr>

</table>

<a href="food-listings.php" class="btn btn-secondary">
<i class="bi bi-arrow-left"></i>
Back
</a>

<?php
if($_SESSION['role']=="NGO" || $_SESSION['role']=="Recipient")
{
?>


<?php

$current_time = date("Y-m-d H:i:s");

if ($current_time > $row['expiry_time'])
{
?>

<button class="btn btn-secondary" disabled>
    Expired
</button>

<?php
}
else
{
?>

<a href="submit-request.php?id=<?php echo $row['listing_ID']; ?>"
   class="btn btn-success">
   <i class="bi bi-hand-index-thumb"></i>
    Request Food
</a>

<?php
}
?>

<?php
}
?>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>