<?php
// Database connection
$conn = new mysqli("localhost", "username", "password", "student_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitize_input($input)
{
    return htmlspecialchars(stripslashes(trim($input)));
}

if (isset($_POST['submit'])) {
    $enrollment_number = sanitize_input($_POST['enrollment_number']);
    $name = sanitize_input($_POST['name']);
    $birth_date = $_POST['birth_date'];
    $contact_number = sanitize_input($_POST['contact_number']);
    $email = sanitize_input($_POST['email']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Check for enrollment number uniqueness
    $check_query = "SELECT * FROM students WHERE enrollment_number = '$enrollment_number'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        die("Enrollment number already exists");
    }

    // Insert student data into the database
    $insert_query = "INSERT INTO students (enrollment_number, name, birth_date, contact_number, email)
                     VALUES ('$enrollment_number', '$name', '$birth_date', '$contact_number', '$email')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Student information added successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['edit'])) {
    $edit_enrollment_number = sanitize_input($_POST['edit_enrollment_number']);
    
    // Retrieve existing student data for editing
    $edit_query = "SELECT * FROM students WHERE enrollment_number = '$edit_enrollment_number'";
    $edit_result = $conn->query($edit_query);

    if ($edit_result->num_rows === 1) {
        $edit_row = $edit_result->fetch_assoc();
        // Implement editing logic here, e.g., update the database with edited values
        // You can pre-fill form fields with existing data for user convenience
    } else {
        echo "Student not found for editing";
    }
}

if (isset($_POST['delete'])) {
    $delete_enrollment_number = sanitize_input($_POST['edit_enrollment_number']);
    
    // Check if the student exists before deletion
    $delete_query = "SELECT * FROM students WHERE enrollment_number = '$delete_enrollment_number'";
    $delete_result = $conn->query($delete_query);

    if ($delete_result->num_rows === 1) {
        // Implement deletion logic here, e.g., DELETE FROM students WHERE ...
        echo "Student deleted successfully";
    } else {
        echo "Student not found for deletion";
    }
}

$conn->close();
?>
