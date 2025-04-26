<?php
session_start();
require '../db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch all documents
$result = $conn->query("SELECT * FROM student_documents");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            cursor: pointer;
            color: #fff;
            border-radius: 5px;
        }
        button[name="action"][value="approve"] {
            background-color: #28a745;
        }
        button[name="action"][value="reject"] {
            background-color: #dc3545;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Course</th>
            <th>ID Proof</th>
            <th>Payment Receipt</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($doc = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $doc['student_id']; ?></td>
                <td><?php echo $doc['course_name']; ?></td>
                <td><a href="/OnlineExam/<?php echo $doc['id_proof']; ?>" target="_blank">View ID Proof</a></td>
                <td><a href="/OnlineExam/<?php echo $doc['payment_receipt']; ?>" target="_blank">View Payment Receipt</a></td>
                <td><?php echo $doc['status']; ?></td>
                <td>
                    <form action="approve.php" method="POST" style="display:inline;">
                        <input type="hidden" name="student_id" value="<?php echo $doc['student_id']; ?>">
                        <button type="submit" name="action" value="approve">Approve</button>
                    </form>
                    <form action="approve.php" method="POST" style="display:inline;">
                        <input type="hidden" name="student_id" value="<?php echo $doc['student_id']; ?>">
                        <button type="submit" name="action" value="reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>