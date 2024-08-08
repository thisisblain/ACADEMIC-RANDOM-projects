# ACADEMIC-RANDOM-projects
A collection of some HTML, CSS, JavaScript, PHP and other projects I have done over the course of my studies. 

# Question1: Car Collection

This project is a simple HTML and JavaScript application that displays a collection of cars in a table format. The table is dynamically generated using JavaScript, which manipulates an array of car names.

## Features

- Displays a list of cars in a table.
- Uses JavaScript to dynamically generate table rows based on an array.
- Demonstrates basic HTML, CSS, and JavaScript integration.

## Code Overview

The HTML structure includes:
- A `<head>` section with a title and CSS styles for the table.
- A `<body>` section containing the table element.

The JavaScript code:
- Initializes an array of car names.
- Modifies the array by removing the last element and adding a new element at the beginning.
- Uses a `for` loop to generate table rows dynamically.

## How to Use

1. Clone or download the repository.
2. Open the `index.html` file in your web browser.
3. The table will display the list of cars in the garage.

## Example

![Screenshot of the Car Collection Table](screenshot.png)

## Code

```html
<!DOCTYPE html>
<html>

<head>
    <title>Car Collection</title>
    <style>
        table,
        td {
            text-align: center;
            border-spacing: 0;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table id="carTable" border="1px solid black">
        <tr>
            <th colspan="2">Cars in my Garage</th>
        </tr>

        <script language="javascript" type="text/javascript">
            var table = document.getElementById("carTable");
            var myArray = new Array();

            myArray[0] = "BMW M4";
            myArray[1] = "Nissan Versa";
            myArray[2] = "Honda Civic";
            myArray[3] = "Hyundai Elantra Hybrid";
            myArray[4] = "Nissan Magnite";
            myArray[5] = "Hyundai Alcazar";

            myArray.pop();
            myArray.unshift("Mercedes Benz S-Class");

            for (var i = 0; i < myArray.length; i++) {
                document.write("<tr><td>MyArray[" + i + "]</td>");
                document.write("<td>" + myArray[i] + "</td></tr>");
            }
        </script>
    </table>
</body>

</html>

