<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != "Admin")
{
    die("Access Denied");
}

/* =========================
   TOTAL USERS
========================= */

$sql = "SELECT COUNT(*) AS total FROM USER";
$result = mysqli_query($conn, $sql);
$total_users = mysqli_fetch_assoc($result)['total'];


/* =========================
   TOTAL FOOD LISTINGS
========================= */

$sql = "SELECT COUNT(*) AS total FROM FOOD_LISTING";
$result = mysqli_query($conn, $sql);
$total_food = mysqli_fetch_assoc($result)['total'];


/* =========================
   FOOD STATUS COUNTS
========================= */

function getStatusCount($conn, $status)
{
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "SELECT COUNT(*) AS total
            FROM FOOD_LISTING
            WHERE status='$status'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result)['total'];
}

$available = getStatusCount($conn, "Available");
$requested = getStatusCount($conn, "Requested");
$collected = getStatusCount($conn, "Collected");
$completed = getStatusCount($conn, "Completed");
$expired = getStatusCount($conn, "Expired");


/* =========================
   TOTAL REQUESTS
========================= */

$sql = "SELECT COUNT(*) AS total FROM REQUEST";
$result = mysqli_query($conn, $sql);
$total_requests = mysqli_fetch_assoc($result)['total'];


/* =========================
   TOTAL DONATIONS
========================= */

$sql = "SELECT COUNT(*) AS total FROM DONATION";
$result = mysqli_query($conn, $sql);
$total_donations = mysqli_fetch_assoc($result)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<!-- <head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FoodBridge Reports</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBridge Reports</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>
                <i class="bi bi-bar-chart"></i>
                FoodBridge Reports
            </h2>

            <p class="text-muted">
                Summary of FoodBridge activities
            </p>
        </div>

        <a href="dashboard.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>


    <!-- SUMMARY CARDS -->

    <div class="row g-4 mb-5">

        <!-- USERS -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Users
                    </h6>

                    <h2>
                        <?php echo $total_users; ?>
                    </h2>

                    <i class="bi bi-people fs-2"></i>

                </div>

            </div>

        </div>


        <!-- FOOD -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Food Listings
                    </h6>

                    <h2>
                        <?php echo $total_food; ?>
                    </h2>

                    <i class="bi bi-basket fs-2"></i>

                </div>

            </div>

        </div>


        <!-- REQUESTS -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Requests
                    </h6>

                    <h2>
                        <?php echo $total_requests; ?>
                    </h2>

                    <i class="bi bi-clipboard-check fs-2"></i>

                </div>

            </div>

        </div>


        <!-- DONATIONS -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Donations
                    </h6>

                    <h2>
                        <?php echo $total_donations; ?>
                    </h2>

                    <i class="bi bi-box-seam fs-2"></i>

                </div>

            </div>

        </div>


        <!-- COMPLETED -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Completed Food
                    </h6>

                    <h2>
                        <?php echo $completed; ?>
                    </h2>

                    <span class="badge bg-secondary">
                        Completed
                    </span>

                </div>

            </div>

        </div>


        <!-- EXPIRED -->

        <div class="col-md-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h6 class="text-muted">
                        Expired Food
                    </h6>

                    <h2>
                        <?php echo $expired; ?>
                    </h2>

                    <span class="badge bg-danger">
                        Expired
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- FOOD STATUS REPORT -->

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <h4 class="mb-4 text-center">
                Food Listing Status Report
            </h4>

            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead class="table-light">

                        <tr>

                            <th>Status</th>

                            <th>Total Listings</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                <span class="badge bg-success">
                                    Available
                                </span>
                            </td>

                            <td>
                                <?php echo $available; ?>
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Requested
                                </span>
                            </td>

                            <td>
                                <?php echo $requested; ?>
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge bg-primary">
                                    Collected
                                </span>
                            </td>

                            <td>
                                <?php echo $collected; ?>
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge bg-secondary">
                                    Completed
                                </span>
                            </td>

                            <td>
                                <?php echo $completed; ?>
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge bg-danger">
                                    Expired
                                </span>
                            </td>

                            <td>
                                <?php echo $expired; ?>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>