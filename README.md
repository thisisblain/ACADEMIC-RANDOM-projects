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
```
# Question2 :Last Updated Date

This project is a simple HTML and JavaScript application that allows users to input and submit a date. The date is then used to display an alert indicating when the page was last updated.

## Features

- Provides a form for users to input a date.
- Displays an alert with the entered date when the form is submitted.
- Includes basic validation to ensure the date input field is not empty.

## Code Overview

The HTML structure includes:
- A `<head>` section with a title.
- A `<body>` section containing a form with a text input field for the date and a submit button.

The JavaScript code:
- Selects the date input field and form.
- Adds an event listener to the form to handle the `submit` event.
- Defines a function `dateUpdate` that displays an alert with the entered date or prompts the user to enter a date if the field is empty.

## How to Use

1. Clone or download the repository.
2. Open the `index.html` file in your web browser.
3. Enter a date in the format `YYYY-MM-DD` in the input field.
4. Click the "Send Update Details" button.
5. An alert will display with the entered date.

## Code

```html
<!DOCTYPE html>
<html>
<head>
    <title>Last Updated</title>
</head>
<body>
    <fieldset>
        <legend>Update Date</legend>
        <form onsubmit="dateUpdate()" id="myForm">
            <div class="updateDate">
                <label> When was this website updated? :</label>
                <input type="text" id="dateInput" placeholder="YYYY-MM-DD" >
            </div>
            <button type="submit" onclick="dateUpdate()" id="btnUpdate" name="updateDetails">Send Update Details</button>
        </form>
    </fieldset>

    <script>
        const dateInput = document.querySelector("#dateInput");
        const myForm = document.querySelector("#myForm");

        myForm.addEventListener("submit", dateUpdate);

        function dateUpdate(e) {
            e.preventDefault();
            if (dateInput.value === "") {
                alert("Please enter the date");
            } else {
                var valueReturned = document.getElementById("dateInput").value;
                alert("This page was last updated on: " + valueReturned);
            }
        }
    </script>
</body>
</html>
```

