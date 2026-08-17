<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$request_id = $_GET['id'];

$sql = "
SELECT
    r.*,
    f.Food_Name,
    f.quantity,
    f.unit,
    f.location,
    f.expiry_time,
    u.full_name
FROM REQUEST r
JOIN FOOD_LISTING f
ON r.listing_id = f.listing_ID
JOIN USER u
ON r.requester_id = u.user_id
WHERE r.Request_ID='$request_id'
";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Request - FoodBridge</title>

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
Request Details
</h3>

</div>

<div class="card-body">

<table class="table">

<tr>
<th width="30%">Request ID</th>
<td><?php echo $row['Request_ID']; ?></td>
</tr>

<tr>
<th>Food Name</th>
<td><?php echo $row['Food_Name']; ?></td>
</tr>

<tr>
<th>Requester</th>
<td><?php echo $row['full_name']; ?></td>
</tr>

<tr>
<th>Requested Quantity</th>
<td>
<?php echo $row['Requested_Quantity']; ?>
<?php echo $row['unit']; ?>
</td>
</tr>

<tr>
<th>Location</th>
<td><?php echo $row['location']; ?></td>
</tr>

<tr>
<th>Expiry Time</th>
<td>
<?php echo date("d M Y h:i A",strtotime($row['expiry_time'])); ?>
</td>
</tr>

<tr>
<th>Status</th>
<td><?php echo $row['request_status']; ?></td>
</tr>

<tr>
<th>Requested At</th>
<td>
<?php echo date("d M Y h:i A",strtotime($row['requested_at'])); ?>
</td>
</tr>

<tr>
<th>Responded At</th>
<td>

<?php

if($row['responded_at'])
{
echo date("d M Y h:i A",strtotime($row['responded_at']));
}
else
{
echo "Not Responded Yet";
}

?>

</td>
</tr>

</table>

<a href="request-food.php" class="btn btn-secondary">
<i class="bi bi-arrow-left"></i>
Back
</a>

</div>

</div>

</div>

</body>
</html>