<?php
session_start();

include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['role'];

// Total Food Listings
$sql = "SELECT COUNT(*) AS total_listings FROM FOOD_LISTING";
$result = mysqli_query($conn,$sql);
$total_listings = mysqli_fetch_assoc($result)['total_listings'];

// Total Requests
$sql = "SELECT COUNT(*) AS total_requests FROM REQUEST";
$result = mysqli_query($conn,$sql);
$total_requests = mysqli_fetch_assoc($result)['total_requests'];

// Completed Donations
$sql = "SELECT COUNT(*) AS completed
FROM REQUEST
WHERE request_status='Completed'";

$result = mysqli_query($conn,$sql);
$completed = mysqli_fetch_assoc($result)['completed'];

// Pending Requests
$sql = "SELECT COUNT(*) AS pending
FROM REQUEST
WHERE request_status='Pending'";

$result = mysqli_query($conn,$sql);
$pending = mysqli_fetch_assoc($result)['pending'];

// Recent Food Listings
$sql = " SELECT * FROM FOOD_LISTING ORDER BY listing_ID DESC LIMIT 5 "; 
$recent_result = mysqli_query($conn,$sql); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FoodBridge</title>

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

                <a href="dashboard.php" class="active">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>

                <a href="food-listings.php">
                    <i class="bi bi-box-seam"></i> Food Listings
                </a>

<?php
if($_SESSION['role']=="Donor" || $_SESSION['role']=="Admin")
{
?>

<a href="post-food.php">
<i class="bi bi-plus-circle"></i> Post Food
</a>

<?php
}
?>

                <a href="request-food.php">
                    <i class="bi bi-envelope"></i> Requests
                </a>

                <a href="donation-history.php">
                    <i class="bi bi-clock-history"></i> Donation History
                </a>

                <a href="report.php">
                    <i class="bi bi-bar-chart-line"></i> Reports
                </a>

                <a href="logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>
          Welcome,
          <span class="text-success">
          <?php echo $_SESSION['full_name'];?> 
          </span>
        </h2>

        <p class="text-muted">

            Making food sharing easier every day.

        </p>
        <p class="text-muted">
         Logged in as:
         <strong class="text-success">
         <?php echo $_SESSION['role']; ?>
         </strong>
        </p>

    </div>

    <div class="text-end">

        <h5 id="currentDate"></h5>

    </div>

</div>

                <!-- Statistics Cards -->
                <div class="row">

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow border-0 dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-box-seam text-success fs-1"></i>
                                <h5 class="mt-3">Total Listings</h5>
                                <h2><?php echo $total_listings; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow border-0 dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-envelope-fill text-primary fs-1"></i>
                                <h5 class="mt-3">Requests</h5>
                                <h2><?php echo $total_requests; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow border-0 dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                <h5 class="mt-3">Completed</h5>
                                <h2><?php echo $completed; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card shadow border-0 dashboard-card">
                            <div class="card-body text-center">
                                <i class="bi bi-hourglass-split text-warning fs-1"></i>
                                <h5 class="mt-3">Pending</h5>
                                <h2><?php echo $pending; ?></h2>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Quick Actions -->
                <div class="mb-4">

                    <h3 class="mb-3">Quick Actions</h3>

                    <a href="post-food.php" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> Post Food
                    </a>

                    <a href="food-listings.php" class="btn btn-outline-success">
                        <i class="bi bi-list-ul"></i> View Listings
                    </a>

                </div>

                <!-- Recent Food Listings -->
                <div class="card shadow border-0">

                    <div class="card-body">

                        <h4 class="mb-4">
                            Recent Food Listings
                        </h4>

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-success">

                                    <tr>
                                        <th>Food Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>

<?php
while($row = mysqli_fetch_assoc($recent_result))
{
?>
<tr>

<td><?php echo $row['Food_Name']; ?></td>

<td>
<?php echo $row['quantity']; ?>
<?php echo $row['unit']; ?>
</td>

<td>

<?php

$status = $row['status'];

if($status=="Available")
{
$badge="success";
}
elseif($status=="Requested")
{
$badge="warning text-dark";
}
elseif($status=="Collected")
{
$badge="primary";
}
elseif($status=="Completed")
{
$badge="secondary";
}
else
{
$badge="dark";
}

?>

<span class="badge bg-<?php echo explode(" ",$badge)[0]; ?>
<?php if(str_contains($badge,"text-dark")) echo "text-dark"; ?>">

<?php echo $status; ?>

</span>

</td>

<td>

<a href="view-food.php?id=<?php echo $row['listing_ID']; ?>"
class="btn btn-success btn-sm">

View

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
<!-- JavaScript for Current Date -->
    <script>

const options = {
    weekday:'long',
    year:'numeric',
    month:'long',
    day:'numeric'
};

document.getElementById("currentDate").innerHTML =
new Date().toLocaleDateString("en-US", options);

</script>

<!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>