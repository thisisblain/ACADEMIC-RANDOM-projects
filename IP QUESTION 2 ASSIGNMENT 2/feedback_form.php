<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <style>
        /* Apply styles to the form container */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style form headings */
h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style labels and input fields */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Style radio buttons */
input[type="radio"] {
    margin-right: 5px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}
/* Style the reset button */
input[type="reset"] {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}
/* Apply styles to the feedback display area */
h3 {
    margin-top: 20px;
    font-size: 20px;
    color: #333;
}

/* Style for the feedback details */
.feedback-details {
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-top: 10px;
}
/* Style radio buttons on a single line */
input[type="radio"] {
    display: inline-block;
    margin-right: 10px;
    vertical-align: middle;
}

    </style>
</head>
<body>
    <h2>Complete this form to submit your feedback</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="title">Title:</label>
        <select id="title" name="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Other">Other</option>
        </select>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="comments">Comments:</label><br>
        <textarea id="comments" name="comments" rows="4" cols="50" required></textarea><br><br>

        <label for="Ratings">Rating:</label>
        <input type="radio" id="excellent" name="rating" value="Excellent" > Excellent
        <input type="radio" id="boring" name="rating" value="Boring"> Boring
        <input type="radio" id="okay" name="rating" value="Okay"> Okay
        <br><br>
</div>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" id= "btnReset" name="reset_button" value="Reset">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Retrieve user inputs
        $title = $_POST['title'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $comments = $_POST['comments'];
        $rating = isset($_POST['rating']) ? $_POST['rating'] : '';

        // Display the user's inputs
        echo "<h3>Your Feedback:</h3>";
        echo "Title: $title<br>";
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Phone Number: $phone<br>";
        echo "Comments: $comments<br>";
        echo "Rating: $rating<br>";
    }
    ?>
</body>
</html>
