<?php 
$conn = new mysqli('localhost', 'root', '', 'online_exam');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'];
$course_name = $_POST['course_name'];

// Fetch student details
$result = $conn->query("SELECT * FROM students WHERE id = $student_id");
$student = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
            background-image: url('images/DALL·E 2025-03-25 13.25.59 - A soft, blurred background with cool tones, depicting a professional setting where a student is making a digital payment to a teacher. The student is .webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            
        }


        .payment-container {
            background: white;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h3 {
            color:rgb(98, 167, 240);
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        form {
            margin-top: 20px;
        }
        input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Payment for <?php echo $course_name; ?></h1>
        <p><strong>Student ID:</strong> <?php echo $student['id']; ?></p>
        <p><strong>Name:</strong> <?php echo $student['name']; ?></p>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="hidden" name="course_name" value="<?php echo $course_name; ?>">
            <form action="status.php" method="GET">
    

            <h3>Upload ID Proof</h3>
            <input type="file" name="id_proof" accept=".jpg, .jpeg, .png, .pdf" required>

            <h3>Upload Payment Receipt</h3>
            <input type="file" name="payment_receipt" accept=".jpg, .jpeg, .png, .pdf" required>

            <button type="submit">Submit Documents</button>
        </form>
    </div>
</body>
</html> 