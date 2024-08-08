<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
html {
    border: 10px solid black;
   
}
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px 160px 40px;
 
    background-color: #f4f4f4;
    border: 8px solid #F9D219;
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

input[type="number"],
input[type="text"],
input[type="date"],
input[type="tel"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Style submit buttons */
input[type="submit"] {
    background-color: purple;
    color: white;
    padding: 10px 20px
}
/* Style reset button */
input[type="reset"] {
    background-color: red;
    color: white;
    padding: 10px 20px
}
.heading{
    border: 6px solid black;
    color: purple;
    padding-right: 320px;
    font-size: 30px;
    
    margin: auto;
    max-width: 400px;
}
    </style>
</head>
<body>
    <div class="heading">
    <h2>Add Student Information</h2>
    </div>
    <br>
    <form class="studentEnrollment" method="post" action="student_info_processing.php">
        Enrollment Number: <input type="number" name="enrollment_number" required><br><br>
        Name: <input type="text" name="name" required><br><br>
        Birth Date: <input type="date" name="birth_date" required><br><br>
        Contact Number: <input type="tel" name="contact_number" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>
    <br>
    <div class="heading">
        <h2>Edit or Delete Student Information</h2>
    </div>
    <br>
    <form method="post" action="student_info_processing.php">
        Enrollment Number: <input type="number" name="edit_enrollment_number" required>
        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
