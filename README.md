# ACADEMIC-RANDOM-projects
A collection of some HTML, CSS, JavaScript, PHP and other projects I have done over the course of my studies. 

# question1: Car Collection

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
# question2 :Last Updated Date

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
# question3: Sign Up Form

This project is a signup form implemented in HTML and JavaScript. The form collects user details and performs validation to ensure the entered data is accurate. It includes fields for names, address, gender, email, mobile number, and location. The CSS can be found at the top of the repo files!

## Features

- Form fields for user input: first name, last name, address, gender, email, mobile number, and location.
- Validation of input fields using regular expressions to ensure correct format.
- Alerts for missing or invalid input.

## Code Overview

### HTML Structure

- **`<head>`**: Includes a Google Font and an external CSS file for styling.
- **`<header>`**: Contains the form title and a logo image.
- **`<body>`**: Includes a form with input fields and buttons for user interaction.

### JavaScript

- **Event Listener**: Added to the form to handle the `submit` event.
- **Validation**: Checks for empty fields and validates input formats using regular expressions.
- **Cookies**: A function is defined to set cookies, but it is incomplete and not functional in the current state.

## How to Use

1. Clone or download the repository.
2. Open the `index.html` file in your web browser.
3. Fill in the form fields and click "Sign-up" to submit.
4. The form will alert you if there are validation issues or missing information.

## Code

```html
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/q3.css">
    <header id="topPage">
        <h1>Sign Up Form</h1>
        <img id="logoSunny" src="images/q3.jfif" alt="The logo for Sunny Side Bowling Club">
    </header>
    <br>
</head>

<body>
    <form id="formId">
        <div class="form-control" id="names"></div>
        <label>First Name:&nbsp;</label>
        <input id="firstName" type="text" name="firstName" placeholder="First Name">
        <br><br>

        <label>Last Name:&nbsp;</label>
        <input id="lastName" type="text" name="lastName" placeholder="Last Name">
        <br><br>
        </div>

        <div id="addressLabel">
            <label>Address:&nbsp;</label>
            <input id="address" type="text" name="addy" placeholder="Address">
            <br><br>
        </div>

        <div id="genders">
            <label>Gender:&nbsp;</label>
            <input id="male" type="radio" name="GenderM" value="male">
            <label for="male">Male</label>

            <input id="female" type="radio" name="GenderF" value="female">
            <label for="female">Female</label>
            <br><br>
        </div>

        <div id="emailAddy">
            <label>Email Id:&nbsp;</label>
            <input id="email" type="text" name="emailAddress" placeholder="example@gmail.com">
            <br><br>
        </div>
        <div id="mobileNumber">
            <label>Mobile:&nbsp;</label>
            <input id="phoneNumber" type="text" name="phone" placeholder="e.g 083 123 1234">
            <br><br>
        </div>

        <div id="locationDiv">
            <label>Location:&nbsp;</label>
            <select class="required" id="selectLocation" name="selectLocation">
                <option value="" disabled selected>Please Select a Location</option>
                <option value="boardwalk">Boardwalk</option>
                <option value="brooklyn">Brooklyn</option>
                <option value="lynnwood">Lynnwood</option>
                <option value="sunnyside">Sunnyside</option>
                <option value="other">Other</option>
            </select>
        </div>
        <br><br>
        <div id="buttons">
            <button type="submit" onclick="" id="btnSign" name="signUp">Sign-up</button>&nbsp;&nbsp;
            <button type="reset" onclick="" id="btnReset" name="re">Reset</button>
        </div>
    </form>

    <script>
        const myForm = document.getElementById("formId");
        const first_Name = document.getElementById("firstName");
        const last_Name = document.getElementById("lastName");
        const theAddress = document.getElementById("address");
        const emailId = document.getElementById("email");
        const mobile = document.getElementById("phoneNumber");
        const radios = document.getElementById("male");
        const radiosTwo = document.getElementById("female");
        const loc = document.getElementById("selectLocation");

        myForm.addEventListener("submit", (e) => {
            e.preventDefault();
            checkInputs();
        });

        function checkInputs() {
            const first_NameValue = first_Name.value.trim();
            const last_NameValue = last_Name.value.trim();
            const theAddressValue = theAddress.value;
            const emailIdValue = emailId.value.trim();
            const mobileValue = mobile.value.trim();

            if (first_NameValue === "") {
                alert("First Name cannot be blank.");
            } else if (!isFirstName(first_NameValue)) {
                alert("Please enter a valid First Name.");
            }

            if (last_NameValue === "") {
                alert("Last Name cannot be blank.");
            } else if (!isLastName(last_NameValue)) {
                alert("Please enter a valid Last Name.");
            }

            if (theAddressValue === "") {
                alert("Your Address cannot be blank.");
            } else if (!isAddress(theAddressValue)) {
                alert("Please enter a valid address.");
            }

            if (!document.getElementById("male").checked && !document.getElementById("female").checked) {
                alert("Pl

