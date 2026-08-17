<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$request_id = $_GET['id'];

$today = date("Y-m-d H:i:s");

/* Get the request information and donor_id via JOIN */
$sql = "
    SELECT r.*, f.donor_id 
    FROM REQUEST r 
    JOIN FOOD_LISTING f ON r.listing_id = f.listing_ID 
    WHERE r.Request_ID='$request_id'
";

$result = mysqli_query($conn,$sql);
$request = mysqli_fetch_assoc($result);

/* Check if the logged-in user is an Admin or the owner of the listing */
// if( $_SESSION['role']!="Admin" && $request['donor_id']!=$_SESSION['user_id'] ) {
//     die("Access Denied");
// }

if ($_SESSION['role']!="Admin" && $request['donor_id']!=$_SESSION['user_id'])
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

            <h4>You cannot approve this request!</h4>

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

/* Update request status */
$sql = "UPDATE REQUEST
        SET
        request_status='Approved',
        responded_at='$today'
        WHERE Request_ID='$request_id'";

mysqli_query($conn,$sql);

/* Update corresponding food listing */
$listing_id = $request['listing_id'];

$sql = "UPDATE FOOD_LISTING
        SET status='Requested'
        WHERE listing_ID='$listing_id'";

mysqli_query($conn,$sql);

/* Return to request page */
header("Location: request-food.php");
exit();
?>