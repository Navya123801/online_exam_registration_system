<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

include 'db.php';
$student_id = $_SESSION['user_id'];

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
    <title>Student Dashboard</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
        }
        /* Left Side with Background Image */
        .left-side {
            flex: 1;
            background-image: url("images/DALL·E 2025-03-24 09.30.51 - A realistic digital illustration of a young man with neatly styled brown hair, wearing a formal suit and tie, sitting at a desk in a modern classroom.webp");
            background-size: cover;
            background-position: center;
        }
        /* Right Side with Student Info */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(122, 116, 116, 0.9);
            padding: 20px;
        }
        .container {
            max-width: 500px;
            width: 80%;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            color: #007bff;
            margin-bottom: 15px;
        }
        .info {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .info p {
            margin: 8px 0;
            font-size: 16px;
        }
        .tag-container {
            display: flex;
            flex-wrap: wrap;
            background: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            min-height: 50px;
            margin: 15px 0;
            text-align: left;
        }
        .tag {
            background: #007bff;
            color: white;
            border-radius: 15px;
            padding: 5px 10px;
            margin: 5px;
            display: flex;
            align-items: center;
        }
        .tag span {
            margin-left: 8px;
            cursor: pointer;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            margin: 10px 0;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            background: #007bff;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Left Side with Image -->
    <div class="left-side"></div>

    <!-- Right Side with Student Info -->
    <div class="right-side">
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($student['name']); ?>!</h1>
            <div class="info">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($student['phone']); ?></p>
            </div>

            <h3>Select Your Course(s)</h3>
            <form action="payment.php" method="POST">
                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                <!-- Selected Courses Display -->
                <div class="tag-container" id="tag-container"></div>

                <!-- Dropdown to Select Courses -->
                <select id="course-select">
                    <option value="" disabled selected>Select a course</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Biology">Biology</option>
                    <option value="Economics">Economics</option>
                    <option value="History">History</option>
                    <option value="Geography">Geography</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Sociology">Sociology</option>
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                </select>

                <!-- Hidden Input to Store Selected Courses -->
                <input type="hidden" name="course_name" id="selected-courses">

                <button type="submit">Proceed to Payment</button>
            </form>
        </div>
    </div>

    <script>
        const tagContainer = document.getElementById('tag-container');
        const courseSelect = document.getElementById('course-select');
        const selectedCoursesInput = document.getElementById('selected-courses');
        let selectedCourses = [];

        // Add course when selected
        courseSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            if (!selectedCourses.includes(selectedValue)) {
                selectedCourses.push(selectedValue);
                updateTags();
            }
            this.value = ""; // Reset dropdown
        });

        // Update tags display and hidden input
        function updateTags() {
            tagContainer.innerHTML = "";
            selectedCourses.forEach(course => {
                const tag = document.createElement('div');
                tag.className = 'tag';
                tag.textContent = course;

                const removeBtn = document.createElement('span');
                removeBtn.textContent = 'x';
                removeBtn.onclick = () => {
                    selectedCourses = selectedCourses.filter(c => c !== course);
                    updateTags();
                };

                tag.appendChild(removeBtn);
                tagContainer.appendChild(tag);
            });

            // Update hidden input with selected courses (comma-separated)
            selectedCoursesInput.value = selectedCourses.join(',');
        }
    </script>
</body>
</html>
