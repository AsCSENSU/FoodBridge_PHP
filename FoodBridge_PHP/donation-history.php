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
    d.Donation_ID,
    d.request_id,
    d.status,
    d.collected_at,
    d.completed_at,
    f.Food_Name,
    u.full_name
FROM DONATION d
JOIN REQUEST r
ON d.request_id = r.Request_ID
JOIN FOOD_LISTING f
ON r.listing_id = f.listing_ID
JOIN USER u
ON r.requester_id = u.user_id
ORDER BY d.Donation_ID ASC
";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Donation History - FoodBridge</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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

<a href="request-food.php">
<i class="bi bi-envelope"></i>
Requests
</a>

<a href="donation-history.php" class="active">
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

<i class="bi bi-clock-history text-success"></i>

Donation History

</h2>

<p class="text-muted">

View completed food donations and collection records.

</p>

<div class="card shadow border-0 mt-4">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th>Donation ID</th>
<th>Request ID</th>
<th>Food Item</th>
<th>Recipient</th>
<th>Status</th>
<th>Collected At</th>
<th>Completed At</th>

</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>

<td><?php echo $row['Donation_ID']; ?></td>

<td><?php echo $row['request_id']; ?></td>

<td><?php echo $row['Food_Name']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td>

<?php

$status = $row['status'];

if($status=="Completed")
{
$badge="success";
}
else
{
$badge="primary";
}

?>

<span class="badge bg-<?php echo $badge; ?>">
<?php echo $status; ?>
</span>

</td>

<td>
<?php echo date("d M Y h:i A", strtotime($row['collected_at'])); ?>
</td>

<td>

<?php

if(!empty($row['completed_at']))
{
    echo date("d M Y h:i A", strtotime($row['completed_at']));
}
else
{
    echo "-";
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