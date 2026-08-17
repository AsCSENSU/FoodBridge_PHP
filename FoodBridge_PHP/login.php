<?php
session_start();
include("config.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM User
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - FoodBridge</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold"
href="index.php">

<i class="bi bi-basket2-fill"></i>
FoodBridge

</a>

<div class="ms-auto">

<a href="index.php"
class="btn btn-outline-light">

Home

</a>

</div>

</div>

</nav>

<section class="hero">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-5">

<div class="card shadow-lg border-0 p-4">

<h2 class="text-center text-success mb-4">

Login

</h2>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Email

</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter your password"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="login"
class="btn btn-success">

Login

</button>

</div>

</form>

<hr>

<p class="text-center">

Don't have an account?

<a href="register.php">

Register

</a>

</p>

</div>

</div>

</div>

</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>