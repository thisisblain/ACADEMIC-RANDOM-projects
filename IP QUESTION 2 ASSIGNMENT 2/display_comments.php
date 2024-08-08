<!DOCTYPE html>
<html>
<head>
    <title>Comments Display Page</title>
    <link rel="stylesheet" href="question2.css">
</head>
<body>

    <h2>Comments</h2>
    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "train_spotters");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and display comments for a specific submission
    $submission_id = $_GET['submission_id'];
    $sql = "SELECT * FROM comments WHERE submission_id = '$submission_id' ORDER BY created_at ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row['comment_text'] . "</p>";
        }
    } else {
        echo "No comments available for this news report.";
    }

    $conn->close();
    ?>
</body>
</html>
