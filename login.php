<?php
include 'db.php';
session_start();  // Start session to keep track of logged-in user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check user
    $query = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];  // Store user ID in session
            $_SESSION['student'] = $row;  // Store all user info
            
            echo "<script>alert('Login successful! Redirecting...'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid credentials'); window.location.href='index.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href='index.html';</script>";
        exit();
    }
}
?>