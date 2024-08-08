<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="question2.css">
  <style>

    </style>
</head>
<body>
    <h2>User Dashboard</h2><br>
   
  <a id="adminLink" href="adminPage.php">Admin Page</a>
  
    <h3>Submit a News Report</h3>
    <form method="post" action="">
        Title: <input type="text" name="title" required><br>
        Description: <textarea name="description" required></textarea><br>
        Media Type: <select name="media_type">
            <option value="image">Image</option>
            <option value="video">Video</option>
        </select><br>
        Media URL: <input type="text" name="media_url" required><br>
        <input type="submit" name="submit" value="Submit Report">
    </form>
    <!-- Display approved news reports here -->
    
    <h2>Approved News Reports</h2>
    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "train_spotters");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and display approved news reports
    $sql = "SELECT * FROM submissions WHERE approved = 1 ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['description'] . "</p>";
            if ($row['media_type'] === 'image') {
                echo "<img src='" . $row['media_url'] . "' alt='Image'>";
            } elseif ($row['media_type'] === 'video') {
                echo "<video src='" . $row['media_url'] . "' controls></video>";
            }
        }
    } else {
        echo "No approved news reports are available at this time.";
    }

    $conn->close();
    ?>

    <?php
session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $media_type = $_POST['media_type'];
    $media_url = $_POST['media_url'];

    // Perform database insert to add news report
    $conn = new mysqli("localhost", "root", "", "train_spotters");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO submissions (user_id, title, description, media_type, media_url) VALUES ('$user_id', '$title', '$description', '$media_type', '$media_url')";

    if ($conn->query($sql) === TRUE) {
        echo "News report has been submitted!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
