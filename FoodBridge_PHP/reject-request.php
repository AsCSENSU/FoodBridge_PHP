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
if( $_SESSION['role']!="Admin" && $request['donor_id']!=$_SESSION['user_id'] ) {
    die("Access Denied");
}

$listing_id = $request['listing_id'];

/* Reject request */
$sql = "UPDATE REQUEST
        SET
        request_status='Rejected',
        responded_at='$today'
        WHERE Request_ID='$request_id'";

mysqli_query($conn,$sql);

/* Make food available again */
$sql = "UPDATE FOOD_LISTING
        SET status='Available'
        WHERE listing_ID='$listing_id'";

mysqli_query($conn,$sql);

header("Location: request-food.php");
exit();
?>