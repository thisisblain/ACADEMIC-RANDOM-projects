<!DOCTYPE html>
<html>
<head>
    <title>Add Comment System</title>
    <link rel="stylesheet" href="question2.css"> 
</head>
<body>
    <h2>Add Comment</h2>
    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $user_id = $_SESSION['user_id'];
        $submission_id = $_POST['submission_id'];
        $comment_text = $_POST['comment_text'];

        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "train_spotters");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the submission exists
        $sql_check_submission = "SELECT * FROM submissions WHERE id = $submission_id";
        $result_check_submission = $conn->query($sql_check_submission);

        if ($result_check_submission->num_rows === 1) {
            // Submission exists, proceed with comment insertion
            $sql_insert_comment = "INSERT INTO comments (submission_id, user_id, comment_text) VALUES ('$submission_id', '$user_id', '$comment_text')";

            if ($conn->query($sql_insert_comment) === TRUE) {
                echo "Comment added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Invalid submission ID or submission does not exist.";
        }

        $conn->close();
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="submission_id" value="<?php echo $_GET['submission_id']; ?>">
        Comment: <textarea name="comment_text" required></textarea><br>
        <input type="submit" name="submit" value="Add Comment">
    </form>
</body>
</html>
