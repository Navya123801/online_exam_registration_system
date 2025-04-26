<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $result = $conn->query("SELECT * FROM students WHERE email = '$email'");
    
    if ($result->num_rows > 0) {
        header("Location: reset_password.php?email=$email");
        exit();
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password | Online Exam</title>

    <!-- Google Fonts for Modern Look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        /* General Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, rgb(0, 102, 204), rgb(230, 245, 255));
            color: #333;
            position: relative;
        }

        /* Background Image with Soft Overlay */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/DALL·E 2025-03-25 14.14.22 - A professional young woman in business attire, holding her head with one hand in a thoughtful or slightly stressed expression, as if trying to remembe.webp') no-repeat center center/cover;
            filter: blur(5px);
            opacity: 0.2;
            z-index: -1;
        }

        /* Card Container */
        .container {
            background: rgba(255, 255, 255, 0.9);
            max-width: 400px;
            width: 90%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1;
        }

        /* Header */
        .container h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Form Inputs */
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        /* Error Message */
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: #007bff;
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

        /* Links */
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
        <h2>Forgot Password</h2>
        
        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <label for="email"><b>Email Address</b></label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Next</button>
        </form>

        <a href="index.html">Back to Login</a>
    </div>

</body>
</html>
