<?php
session_start();
include 'db.php';

// Fetch student_id from URL parameter
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;

// Check if student_id is missing
if (!$student_id) {
    echo "Error: Student ID is missing!";
    exit();
}

// Fetch student details from the students table (excluding course_name)
$query = "
    SELECT students.*, student_documents.course_name 
    FROM students 
    INNER JOIN student_documents ON students.id = student_documents.student_id 
    WHERE students.id = $student_id
";

$result = $conn->query($query);
if (!$result) {
    die("Error in query: " . $conn->error); // Debugging for SQL errors
}

$student = $result->fetch_assoc();

// Check if student exists
if (!$student) {
    echo "Error: Student not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alliance University - Hall Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
            border: 2px solid #000;
        }
        h1, h2 {
            text-align: center;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .instructions {
            margin-top: 30px;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Alliance University</h1>
    <h2>Exam Hall Ticket</h2>

    <table>
        <tr>
            <th>Student ID</th>
            <td><?= $student['id'] ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= $student['name'] ?></td>
        </tr>
        <tr>
            <th>Course</th>
            <td><?= $student['course_name'] ?></td> 
        </tr>
        <tr>
            <th>Subject Code</th>
            <td><?= strtoupper(substr($student['course_name'], 0, 3)) . '' . $student['id'] ?></td>
        </tr>
        <tr>
            <th>Exam Date</th>
            <td><?= date('d-m-Y') ?></td>
        </tr>
        <tr>
            <th>Exam Time</th>
            <td>10:00 AM - 1:00 PM</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>Approved</td>
        </tr>
        <tr>
            <th>Exam Fee</th>
            <td>₹500</td>
        </tr>
    </table>

    <div class="signature">
        <div>
            <strong>Instructor Sign:</strong> ___________
        </div>
        <div>
            <strong>Student Sign:</strong> ___________
        </div>
    </div>

    <div class="instructions">
        <h3>Instructions to Candidates</h3>
        <ul>
            <li>The Hall ticket must be presented for verification along with student ID.</li>
            <li>Student must report at the examination hall 15 minutes before the commencement of examination.</li>
            <li>No Student will be allowed to enter the examination hall after 15 minutes from the time of commencement.</li>
            <li>Mobile Phone, Smart Watch, or any other electronic devices are strictly prohibited in the examination hall.</li>
            <li>Scientific Calculator can be allowed only if necessary.</li>
            <li>Student should write their registration number only in the space provided on the answer booklets.</li>
            <li>If a student is found guilty of malpractice or misconduct during the examination, strict necessary action will be taken.</li>
        </ul>
    </div>

    <button onclick="window.print()">Download PDF</button>
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
