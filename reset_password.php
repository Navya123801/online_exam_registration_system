<?php
session_start();
include 'db.php';

// Check if email is in the URL
if (!isset($_GET['email'])) {
    echo "<script>alert('No email provided!'); window.location='forgot_password.php';</script>";
    exit();
}

$email = $conn->real_escape_string($_GET['email']);
$result = $conn->query("SELECT * FROM students WHERE email = '$email'");

if ($result->num_rows === 0) {
    echo "<script>alert('Invalid email!'); window.location='forgot_password.php';</script>";
    exit();
}

// Handle password update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
    
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $conn->query("UPDATE students SET password = '$hashed_password' WHERE email = '$email'");
        echo "<script>alert('Password updated successfully! Redirecting to login...'); window.location='index.html';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password | Online Exam</title>

    <!-- Google Fonts for Clean Look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        /* Body with Blurred Background */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Blurred Background Layer */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/DALL·E 2025-03-25 19.21.26 - A modern digital illustration symbolizing password reset. The scene shows a sleek laptop or smartphone with a glowing lock icon, a progress bar beneat.webp') no-repeat center center/cover;
            background-attachment:fixed;
           
        }

        /* Container for Reset Password */
        .container {
            background:white;
            max-width: 350px;
            width: 90%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1;
        }

        /* Title */
        .container h2 {
            color:rgb(18, 73, 133);
            margin-bottom: 20px;
        }

        /* Input Fields */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background:rgb(18, 73, 133);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #0056b3;
        }

        /* Back to Login Link */
        a {
            text-decoration: none;
            color: #007bff;
            display: inline-block;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST">
            <label for="email"><b>Email</b></label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>

            <label for="password"><b>New Password</b></label>
            <input type="password" name="password" placeholder="Enter new password" required>

            <label for="confirm_password"><b>Confirm Password</b></label>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>

            <button type="submit">Change Password</button>
        </form>

        <a href="index.html">Back to Login</a>
    </div>

</body>
</html>
