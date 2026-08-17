<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$request_id = $_GET['id'];

/* Get request + food owner */
$sql = "
SELECT
r.*,
f.listing_ID,
f.donor_id
FROM REQUEST r
JOIN FOOD_LISTING f
ON r.listing_id = f.listing_ID
WHERE r.Request_ID='$request_id'
";

$result = mysqli_query($conn,$sql);

$request = mysqli_fetch_assoc($result);

if(!$request)
{
    die("Request not found.");
}

/* Authorization */
// if($_SESSION['role']!="Admin" && $request['donor_id']!=$_SESSION['user_id'])
// {
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

            <h4>You can not confirm this request!</h4>

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

/* Update request */
$sql = "
UPDATE REQUEST
SET request_status='Completed'
WHERE Request_ID='$request_id'
";

mysqli_query($conn,$sql);

/* Create Donation record */

$sql = "
INSERT INTO DONATION
(request_id, status, collected_at, completed_at)
SELECT
    '$request_id',
    'Completed',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1
    FROM DONATION
    WHERE request_id='$request_id'
)
";

mysqli_query($conn,$sql);

/* Update food listing */
$sql = "
UPDATE FOOD_LISTING
SET status='Completed'
WHERE listing_ID='".$request['listing_ID']."'
";

mysqli_query($conn,$sql);

header("Location: request-food.php");
exit();
?>