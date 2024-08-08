<!DOCTYPE html>
<htmL>
<head>
    <title>Approve the Submissions</title>
</head>
<?php
if (isset($_POST['approve'])) {
    $submission_id = $_POST['submission_id'];

    // Update the submission as reviewed and approved in the database
    $conn = new mysqli("localhost", "root", "", "train_spotters");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE submissions SET reviewed = 1, approved = 1 WHERE id = $submission_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: adminPage.php"); // Redirect back to the admin page
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
