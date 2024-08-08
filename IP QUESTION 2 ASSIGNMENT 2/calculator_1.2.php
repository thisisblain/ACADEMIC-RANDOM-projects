<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h2>Calculator</h2>

    <?php
    // Initialize variables
    $num1 = "";
    $num2 = "";
    $result = "";
    $operation = "";

    if (isset($_POST['submit'])) {
        // Get user input
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];

        // Perform the selected operation
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Division by zero error";
                }
                break;
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table border="1">
            <tr>
                <th>Your Result</th>
                <th><?php echo $result ; ?></th>
            </tr>
            <tr>
                <td><label for="num1">Enter first number: </label>
         </td>
                <td><input type="number" name="num1" value="<?php echo $num1; ?>"required></td>
            </tr>
            <tr>
                <td><label for="num2">Enter second number: </label></td>
                <td><input type="number" name="num2" value="<?php echo $num2; ?>" required></td>
            </tr>
            <tr>
                <td><label for="operation">Select Your Choice:</label></td>
                <td>
                    <select name="operation">
                        <option value="add">+</option>
                        <option value="subtract">-</option>
                        <option value="multiply">x</option>
                        <option value="divide">/</option>
                    </select>>
            </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" name="submit" value="Calculate"></td>
               
            </tr>
        </table>

        <br>

        

        
    </form>
</body>
</html>
