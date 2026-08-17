<?php
include("config.php");

if(isset($_POST['register']))
{
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (strlen($password) < 8)
{
    echo "

    <script>

    alert('Password must contain at least 8 characters.');

    window.history.back();

    </script>

    ";

    exit();
}
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    if($role == "Admin")
{
    echo "<script>
            alert('Admin registration is not allowed.');
            window.history.back();
          </script>";
    exit();
}
    $address = $_POST['address'];

    // Check if email already exists
    $check = "SELECT * FROM User WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0)
    {
        echo "<script>
                alert('This email is already registered. Please use another email or login.');
              </script>";
    }
    else
    {
        $sql = "INSERT INTO User
        (full_name, email, password, phone, role, address, created_at)
        VALUES
        ('$full_name', '$email', '$password', '$phone', '$role', '$address', NOW())";

        if(mysqli_query($conn, $sql))
        {
            echo "<script>
                    alert('Registration Successful!');
                    window.location='login.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Registration Failed!');
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - FoodBridge</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">

        <div class="container">

            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-basket2-fill"></i> FoodBridge
            </a>

            <a href="index.php" class="btn btn-outline-light">
                Home
            </a>

        </div>

    </nav>

    <!-- Register Section -->
    <section class="hero">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card shadow-lg border-0 p-5">

                        <h2 class="text-center text-success mb-4">
                            Create Account
                        </h2>

                        <form method="POST">

                            <div class="row">

                                <!-- Full Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input
type="text"
name="full_name"
class="form-control"
placeholder="Enter your full name">
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input
type="text"
name="phone"
class="form-control"
placeholder="01XXXXXXXXX">
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input
type="password"
name="password"
class="form-control"
placeholder="Create password"
minlength="8"
required>
                                </div>

                                <!-- Role -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Role</label>

                                    <select
name="role"
class="form-select">

                                        <option selected disabled>Select your role</option>

                                        <option value="Donor">Donor</option>
<option value="NGO">NGO</option>
<option value="Recipient">Recipient</option>
<!-- <option value="Admin">Admin</option> -->

                                    </select>

                                </div>

                                <!-- Address -->
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Address</label>
                                    <input
type="text"
name="address"
class="form-control"
placeholder="Enter your address">
                                </div>

                            </div>

                            <div class="d-grid">

                                <button
type="submit"
name="register"
class="btn btn-success">

                                    Register

                                </button>

                            </div>

                        </form>

                        <hr>

                        <p class="text-center">

                            Already have an account?

                            <a href="login.php">

                                Login

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