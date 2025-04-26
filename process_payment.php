<?php
$conn = new mysqli('localhost', 'root', '', 'online_exam');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course_name = $_POST['course_name'];
    $payment_method = $_POST['payment_method'];

    // Handle ID Proof Upload
    $uploadDir = 'uploads/';
    $idProofName = basename($_FILES['id_proof']['name']);
    $uploadFilePath = $uploadDir . $idProofName;

    if (move_uploaded_file($_FILES['id_proof']['tmp_name'], $uploadFilePath)) {
        // Update student record
        $updateQuery = "UPDATE students SET subject = '$course_name', payment_status = 'completed' WHERE id = $student_id";

        if ($conn->query($updateQuery) === TRUE) {
            header("Location: hallticket.php?student_id=$student_id");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload ID proof.";
    }
}

$conn->close();
?>
