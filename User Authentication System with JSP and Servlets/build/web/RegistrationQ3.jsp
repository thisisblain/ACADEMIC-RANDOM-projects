<%-- 
    Document   : RegistrationQ3
    Created on : 2 Sept 2024, 15:22:09
    Author     : Blain Holland
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registration Page</title>
        <style>
    .container {
    max-width: 500px;
    padding: 20px;
    background: #f4f7f8;
    margin: 20px auto;
    border-radius: 8px;
    font-family: Georgia, "Times New Roman", Times, serif;
}

.container fieldset {
    border: none;
    padding: 0;
}

.container legend {
    font-size: 1.4em;
    margin-bottom: 10px;
}

.container label {
    display: block;
    margin-bottom: 8px;
}

.container input[type="text"],
.container input[type="password"],
.container input[type="submit"] {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

.container input[type="text"]:focus,
.container input[type="password"]:focus {
    background: #d2d9dd;
    border-color: #1abc9c;
}

.container .number {
    background: #1abc9c;
    color: #fff;
    height: 30px;
    width: 30px;
    display: inline-block;
    font-size: 0.8em;
    margin-right: 4px;
    line-height: 30px;
    text-align: center;
    border-radius: 15px 15px 15px 0px;
}

.container input[type="submit"] {
    background: #1abc9c;
    color: #fff;
    border: 1px solid #16a085;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.container input[type="submit"]:hover {
    background: #109177;
}

/* Error message styling */
.container .error {
    color: red;
    font-size: 0.9em;
    margin-top: 10px;
}

</style>
    </head>
    <body>
<div class="container">
    <h2>Register</h2>
    <fieldset>
        <legend><span class="number">1</span> Candidate Information</legend>
    <form action="RegistrationServlet" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="submit" value="Register">
        
    </form>
        </fieldset>
     
        <!-- Displaying the message -->
        <c:if test="${not empty message}">
            <div class="message">${message}</div>
        </c:if>
</div>
</body>
</html>
