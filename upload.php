<?php
// DB Connection
$conn = new mysqli('localhost', 'root', '', 'online_exam');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$student_id = $_POST['student_id'];
$course_name = $_POST['course_name'];

// Handle file uploads
$id_proof_path = 'uploads/' . basename($_FILES['id_proof']['name']);
$payment_receipt_path = 'uploads/' . basename($_FILES['payment_receipt']['name']);

// Create uploads directory if not exists
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

// Move uploaded files to 'uploads/' directory
move_uploaded_file($_FILES['id_proof']['tmp_name'], $id_proof_path);
move_uploaded_file($_FILES['payment_receipt']['tmp_name'], $payment_receipt_path);

// Insert data into student_documents table
$conn->query("INSERT INTO student_documents (student_id, course_name, id_proof, payment_receipt, status)
              VALUES ('$student_id', '$course_name', '$id_proof_path', '$payment_receipt_path', 'Pending')");

// Redirect to status page after uploading
$conn->close();
header("Location: status.php?student_id=$student_id");
exit;
?>
