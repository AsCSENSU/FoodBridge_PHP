<?php
session_start();
include("config.php");

// User must be logged in
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

// Check if ID exists
if(isset($_GET['id']))
{
    $id = $_GET['id'];

$sql = "SELECT * FROM FOOD_LISTING
        WHERE listing_ID='$id'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

if(
$_SESSION['role']!="Admin"
&&
$row['donor_id']!=$_SESSION['user_id']
)
{
die("Access Denied");
}

    $sql = "DELETE FROM FOOD_LISTING WHERE listing_ID = '$id'";

    // if(mysqli_query($conn, $sql))
    // {
    //     header("Location: food-listings.php");
    //     exit();
    // }
    // else
    // {
    //     echo "Delete Failed!";
    // }
try
{
if(mysqli_query($conn, $sql))
{
    header("Location: food-listings.php");
    exit();
}
}
// catch(mysqli_sql_exception $e)
// {
//     echo "<div style='
//         margin:50px auto;
//         max-width:600px;
//         padding:25px;
//         background:#f8d7da;
//         color:#842029;
//         border:1px solid #f5c2c7;
//         border-radius:12px;
//         font-family:Arial;
//         text-align:center;
//     '>";

//     echo "<h3>Delete Failed</h3>";
//     echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
//     echo "<a href='food-listings.php'
//              style='
//              display:inline-block;
//              padding:10px 20px;
//              background:#198754;
//              color:white;
//              text-decoration:none;
//              border-radius:25px;
//              '>
//              Back to Food Listings
//           </a>";

//     echo "</div>";
// }
catch(mysqli_sql_exception $e)
{
    $error_code = $e->getCode();

    if($error_code == 1451)
    {
        $message = "This food listing cannot be deleted because it has an existing request.";
    }
    elseif($error_code == 1644)
    {
        $message = $e->getMessage();
    }
    else
    {
        $message = "The food listing could not be deleted. Please try again.";
    }

    echo "<div style='
        margin:50px auto;
        max-width:600px;
        padding:25px;
        background:#f8d7da;
        color:#842029;
        border:1px solid #f5c2c7;
        border-radius:12px;
        font-family:Arial;
        text-align:center;
    '>";

    echo "<h3>Delete Failed</h3>";

    echo "<p>" . htmlspecialchars($message) . "</p>";

    echo "<a href='food-listings.php'
             style='
             display:inline-block;
             padding:10px 20px;
             background:#198754;
             color:white;
             text-decoration:none;
             border-radius:25px;
             '>
             Back to Food Listings
          </a>";

    echo "</div>";
}
}
?>