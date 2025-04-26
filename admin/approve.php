<?php
session_start();
require '../db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['student_id']) && isset($_POST['action'])) {
    $student_id = $_POST['student_id'];
    $action = $_POST['action'];

    $status = ($action === 'approve') ? 'Approved' : 'Pending';
    
    if ($conn->query("UPDATE student_documents SET status='$status' WHERE student_id=$student_id")) {
        echo "<script>alert('Registered and Approved Successfully'); window.location.href='dashboard.php';</script>";
        exit();
    }
}

header("Location: dashboard.php");
exit();
?>
