<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$search = "";
$status_filter = "";

// Search
if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Status filter
if(isset($_GET['status']))
{
    $status_filter = mysqli_real_escape_string($conn, $_GET['status']);
}

// Build SQL
$sql = "SELECT * FROM FOOD_LISTING
        WHERE Food_Name LIKE '%$search%'";

// Apply status filter
if($status_filter != "")
{
    $sql .= " AND status='$status_filter'";
}

// Order results
$sql .= " ORDER BY listing_ID ASC";


        
$current_time = date("Y-m-d H:i:s");

mysqli_query(
    $conn,
    "UPDATE FOOD_LISTING
     SET status='Expired'
     WHERE expiry_time < '$current_time'
     AND status='Available'"
);

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Listings - FoodBridge</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
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

<a href="food-listings.php" class="active">
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

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">
            <i class="bi bi-box-seam text-success"></i>
            Food Listings
        </h2>

        <p class="text-muted mb-0">
            Manage all available food donations efficiently.
        </p>

    </div>

</div>

<div class="row mb-4">

<div class="col-md-6">

<form method="GET">

    <div class="input-group">

        <span class="input-group-text bg-success text-white">
            <i class="bi bi-search"></i>
        </span>

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by food name..."
            value="<?php echo htmlspecialchars($search); ?>">

        <button type="submit" class="btn btn-success">
            Search
        </button>

    </div>

</form>

</div>

<div class="col-md-6 text-md-end mt-3 mt-md-0">

<a href="post-food.php"
class="btn btn-success px-4">

<i class="bi bi-plus-circle-fill"></i>

Add New Food

</a>


</div>

</div>

<div class="card shadow border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-success">

<tr>

<th>ID</th>
<th>Food Name</th>
<th>Quantity</th>
<th>Location</th>
<th>Expiry</th>
<!-- <th>Status</th> -->
 <th>
    <select class="form-select form-select-sm"
            onchange="window.location.href=this.value"
            style="width:120px; margin:auto; font-weight:550; text-align-last: center;">

        <option value="food-listings.php"
            <?php if($status_filter == "") echo "selected"; ?>>
            Status
        </option>

        <option value="food-listings.php?status=Available"
            <?php if($status_filter == "Available") echo "selected"; ?>>
            Available
        </option>

        <option value="food-listings.php?status=Requested"
            <?php if($status_filter == "Requested") echo "selected"; ?>>
            Requested
        </option>

        <option value="food-listings.php?status=Collected"
            <?php if($status_filter == "Collected") echo "selected"; ?>>
            Collected
        </option>

        <option value="food-listings.php?status=Completed"
            <?php if($status_filter == "Completed") echo "selected"; ?>>
            Completed
        </option>

        <option value="food-listings.php?status=Expired"
            <?php if($status_filter == "Expired") echo "selected"; ?>>
            Expired
        </option>

    </select>
</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>


    <td><?php echo $row['listing_ID']; ?></td>

    <td><?php echo $row['Food_Name']; ?></td>

    <td>
        <?php echo $row['quantity']; ?>
        <?php echo $row['unit']; ?>
    </td>

    <td><?php echo $row['location']; ?></td>

    <td><?php echo date("d M Y h:i A", strtotime($row['expiry_time'])); ?></td>

<td>
 <?php

$status = $row['status'];

if($status=="Available"){
    $badge="success";
}
elseif($status=="Requested"){
    $badge="warning text-dark";
}
elseif($status=="Collected"){
    $badge="primary";
}
elseif($status=="Completed"){
    $badge="secondary";
}
elseif($status == "Expired")
{
    $badge = "danger";
}
else{
    $badge="dark";
}

?>

<span class="badge bg-<?php echo explode(" ",$badge)[0]; ?> <?php if(str_contains($badge,"text-dark")) echo "text-dark"; ?>">
    <?php echo $status; ?>
</span>
    </td>

    <td>

        <a href="view-food.php?id=<?php echo $row['listing_ID']; ?>"
          class="btn btn-sm btn-primary">
          <i class="bi bi-eye"></i>
        </a>

        <a href="edit-food.php?id=<?php echo $row['listing_ID']; ?>"
          class="btn btn-sm btn-warning">
          <i class="bi bi-pencil"></i>
        </a>

        <a href="delete-food.php?id=<?php echo $row['listing_ID']; ?>"
          class="btn btn-sm btn-danger"
          onclick="return confirm('Are you sure you want to delete this food listing?');">
          <i class="bi bi-trash"></i>
        </a>

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