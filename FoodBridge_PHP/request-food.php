<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$sql = "
SELECT
    r.*,
    f.Food_Name,
    f.unit,
    u.full_name
FROM REQUEST r
JOIN FOOD_LISTING f
ON r.listing_id = f.listing_ID
JOIN USER u
ON r.requester_id = u.user_id
ORDER BY r.Request_ID ASC
";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Requests - FoodBridge</title>

    <!-- Bootstrap -->
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

<a href="post-food.php">
<i class="bi bi-plus-circle"></i>
Post Food
</a>

<a href="request-food.php" class="active">
<i class="bi bi-envelope-fill"></i>
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

<i class="bi bi-envelope-fill text-success"></i>

Food Requests

</h2>

<p class="text-muted">

Manage incoming food requests from NGOs and recipients.

</p>

<div class="card shadow border-0 mt-4">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th>Request ID</th>
<th>Food Item</th>
<th>Requester</th>
<th>Quantity</th>
<th>Status</th>
<th>Requested At</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>

    <td><?php echo $row['Request_ID']; ?></td>

    <td><?php echo $row['Food_Name']; ?></td>

    <td><?php echo $row['full_name']; ?></td>

    <td>
        <?php echo $row['Requested_Quantity']; ?>
        <?php echo $row['unit']; ?>
    </td>

    <td>

<?php

$status = $row['request_status'];

if($status=="Pending")
{
    $badge="warning text-dark";
}
elseif($status=="Approved")
{
    $badge="success";
}
elseif($status=="Rejected")
{
    $badge="danger";
}
else
{
    $badge="secondary";
}

?>

<span class="badge bg-<?php echo explode(" ",$badge)[0]; ?> <?php if(str_contains($badge,"text-dark")) echo "text-dark"; ?>">
    <?php echo $status; ?>
</span>

    </td>

    <td>
        <?php echo date("d M Y h:i A",strtotime($row['requested_at'])); ?>
    </td>

    <td>

<?php
if($status=="Pending")
{
?>

<a href="approve-request.php?id=<?php echo $row['Request_ID']; ?>" class="btn btn-success btn-sm">
<i class="bi bi-check-lg"></i>
    Approve
</a>

<a href="reject-request.php?id=<?php echo $row['Request_ID']; ?>"
   class="btn btn-danger btn-sm">
    <i class="bi bi-x-lg"></i>
    Reject
</a>

<?php
}
else
{
?>

<a href="view-request.php?id=<?php echo $row['Request_ID']; ?>"
class="btn btn-primary btn-sm">
<i class="bi bi-eye"></i>
View
</a>

<?php
if($status=="Approved")
{
?>

<a href="complete-donation.php?id=<?php echo $row['Request_ID']; ?>"
class="btn btn-success btn-sm"
onclick="return confirm('Mark this donation as completed?');">

<i class="bi bi-check2-circle"></i>

Complete

</a>

<?php
}
?>

<?php
}
?>

    </td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>