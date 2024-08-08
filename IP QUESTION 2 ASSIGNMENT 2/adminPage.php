<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="question2.css"> <!-- Include your CSS file -->
    <style>
      .topnav {
    overflow: hidden;
    background-color: #333;
  }
  .topnav a {
    
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }
        </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <div class="topnav">
  <a class="active" href="loginQ2.php">Home</a>
  <a href="dashboard.php">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
</div>
    </header>
    <div class="container">
        <h2>Submissions to Review</h2>
        <?php
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "train_spotters");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and display submissions that need review
        $sql = "SELECT * FROM submissions WHERE reviewed = 0 ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='submission'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                if ($row['media_type'] === 'image') {
                    echo "<img src='" . $row['media_url'] . "' alt='Image'>";
                } elseif ($row['media_type'] === 'video') {
                    echo "<video src='" . $row['media_url'] . "' controls></video>";
                }
                echo "<form method='post' action='approve_submission.php'>";
                echo "<input type='hidden' name='submission_id' value='" . $row['id'] . "'>";
                echo "<input type='submit' name='approve' value='Approve'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No submissions to review.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
