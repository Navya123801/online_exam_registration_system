# 🎓 Online Exam Registration System

This is a fully functional web application designed to manage student exam registrations online. It allows students to register, upload documents, make payments, and download their hall tickets, while administrators manage backend data and exam details.

Built using: **PHP**, **HTML**, **CSS**, **MySQL**

---

## ✨ Key Features

- ✔️ Student registration and document upload
- ✔️ Login with password reset
- ✔️ Online payment functionality
- ✔️ Hall ticket generation
- ✔️ Admin dashboard to monitor and manage

---

## 📁 Project File Descriptions & Their Usefulness

### 🔐 `register.php`
- Displays a registration form that collects student details (name, email, roll number, etc.).
- ✅ **How this helps**: It begins the student's journey in the system, ensuring all necessary data is collected and stored in the database.

---

### 🔑 `login.php`
- Lets registered students log in using their email and password.
- Checks credentials against the database.
- ✅ **How this helps**: Keeps the system secure by allowing only authenticated users to access dashboards or download hall tickets.

---

### ❓ `forgot_password.php` & 🔄 `reset_password.php`
- Allows users to recover their accounts through email verification and password reset.
- ✅ **How this helps**: Prevents students from getting locked out and ensures smooth access even if credentials are forgotten.

---

### 💼 `dashboard.php`
- Shows student details, registration status, exam details, uploaded documents, and payment status.
- ✅ **How this helps**: Centralized view where students manage everything without confusion.

---

### 💳 `payment.php` / `process_payment.php`
- Displays payment form for exam fees.
- Handles transaction logic and updates payment status in the database.
- ✅ **How this helps**: Makes it easy for students to pay fees online without physical cash submission or offline processes.

---

### 📄 `hallticket.php`
- Generates a printable/downloadable hall ticket with student data and exam details.
- ✅ **How this helps**: Acts as official proof to enter and appear for exams, avoiding manual issuance.

---

### ⬆️ `upload.php`
- Manages student file uploads like photo IDs.
- ✅ **How this helps**: Ensures all required verification documents are safely stored and can be accessed by the admin.

---

### 🚪 `logout.php`
- Ends the user session and redirects to login.
- ✅ **How this helps**: Improves security by preventing unauthorized access after session timeout or logout.

---

### 🧠 `db.php`
- Contains code for database connection.
- Used by all PHP files to communicate with MySQL.
- ✅ **How this helps**: Centralizes database logic so it’s easy to configure and secure.

---

## 🗂️ Folders Overview

- `/admin` – Contains admin-specific pages for managing registrations and data  
  ✅ **Helps admins monitor and update backend efficiently**

- `/images` – Holds UI screenshots and design assets  
  ✅ **Useful for documentation and visual representation**

- `/uploads` – Stores uploaded files securely  
  ✅ **Ensures students' documents are not lost or misfiled**

---

## 🧪 System Workflow with Screenshots

### 1. 📝 Registration Form  
Students fill in their information  
![Registration](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(122).png)

---

### 2. 🔐 Login Page  
Secure student login  
![Login](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(119).png)

---

### 3. 🔑 Forgot Password  
Students can enter the email id here
![Forgot Password](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(120).png)

---

### 4. 🔄 Reset Password  
Allows students to securely reset their password  
![Reset Password](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(121).png)

---

### 5. 📊 Student Dashboard  
Allows student to select the course 
![Dashboard](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(124).png)

---

### 6. 💳 Payment Page  
upload the id and payment successful receipt 
![Payment](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(126).png)

---
### 7. 📄 Status Page  
After payment, students can view their application status:  
- **Pending** (waiting for admin approval)  
- **Approved** (application verified by admin)  
- **Rejected** (application rejected by admin)  
![Status](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(127).png)

---

### 7. 🛡️ Admin Login Page  
Admins can securely login to manage exam registrations  
![Admin Login](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(128).png)

---

### 8. 🖥️ Admin Dashboard  
Admins can review student registrations, approve or reject applications 
![Admin Dashboard](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(129).png)

### 9. 🎟️ Hall Ticket  
If admin approved the application ,then only student can get exam hall ticket  
![Hall Ticket](https://github.com/Navya123801/online_exam_registration_system/blob/main/images/Screenshot%20(131).png)

---


## ⚙️ Setup Instructions (Using XAMPP)

To run this project locally, follow the steps below:

1. **Install [XAMPP](https://www.apachefriends.org/)** on your system.

2. **Start Apache and MySQL** using the XAMPP Control Panel.

3. **Create the database**:
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a new database (e.g., `exam_registration`).
   - Import the `.sql` file if available (e.g., `exam_registration.sql`).

4. **Configure Database Connection**:
   - Open the `db.php` file.
   - Update the following lines with your database credentials:
     ```php
     $conn = mysqli_connect("localhost", "root", "", "exam_registration");
     ```

5. **Move the Project Folder**:
   - Copy your project folder (e.g., `online_exam_registration_system`) into the `htdocs` directory.
     ```
     C:/xampp/htdocs/online_exam_registration_system
     ```

6. **Run the Project**:
   - Open your browser and navigate to:  
     [http://localhost/online_exam_registration_system/](http://localhost/online_exam_registration_system/)

---

## 🚀 Future Enhancements & Hosting

This project was tested for live deployment, highlighting its potential for real-world use. During initial hosting attempts using a free service, email-related features were flagged due to unverified/test email IDs.

To make this system **production-ready**, the following improvements can be considered:

✅ **Verified SMTP integration** (e.g., Gmail, SendGrid) for secure emails like OTP and password reset  
✅ **Email validation** during registration  
✅ **CAPTCHA integration** to block bots and spam  
✅ **Cloud Hosting** on platforms like AWS, Vercel, Hostinger, etc.

🔧 These enhancements will make the system secure, scalable, and ready for large-scale academic deployments.

---

## 👩‍💻 Author

**Navya BP**  
BTech CSE Student  
GitHub: [Navya123801](https://github.com/Navya123801)
