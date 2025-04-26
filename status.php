<?php
$conn = new mysqli('localhost', 'root', '', 'online_exam');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;
if (!$student_id) {
    echo "No student ID provided.";
    exit;
}

// Fetch status
$result = $conn->query("SELECT * FROM student_documents WHERE student_id = $student_id");
$document = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Status Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f0f0f0;
        }
        /* Animated Background */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/DALL·E 2025-03-25 13.49.23 - A soft, blurred background featuring scattered documents with subtle checkmarks and stamps, creating a clean and professional atmosphere. The color pa.webp') no-repeat center center fixed;
            background-size: cover;
            animation: zoomBackground 15s infinite alternate;
            z-index: -1;
        }
        @keyframes zoomBackground {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.1);
            }
        }
        .status-container {
            background:white;
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1;
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 16px;
            margin: 15px 0;
        }
        .approved {
            color: green;
            font-weight: bold;
        }
        .pending {
            color: orange;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="status-container">
        <h1>Application Status</h1>
        <p><strong>Student ID:</strong> <?php echo $document['student_id']; ?></p>
        <p><strong>Course:</strong> <?php echo $document['course_name']; ?></p>

        <?php if ($document['status'] === 'Approved') { ?>
            <p class="approved">Status: Approved ✅</p>
            <a href="hallticket.php?student_id=<?php echo $student_id; ?>" class="button">Download Hall Ticket</a>
        <?php } else { ?>
            <p class="pending">Status: Pending ⏳</p>
        <?php } ?>
    </div>
</body>
</html>  