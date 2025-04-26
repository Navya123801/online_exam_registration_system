<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];

    // Check if email already exists
    $checkQuery = "SELECT id FROM students WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email already registered. Please log in.'); window.location.href='index.html';</script>";
        exit();
    }

    // Insert new user
    $query = "INSERT INTO students (name, email, password, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $password, $phone);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error occurred while registering.'); window.location.href='register.html';</script>";
    }
}
?>
