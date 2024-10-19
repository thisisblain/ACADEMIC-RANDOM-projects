<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page session="true" %>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
            margin: 10px 0;
        }
        .info {
            background-color: #e7f3fe;
            padding: 10px;
            border-radius: 5px;
            color: #31708f;
            margin-top: 15px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<%
    String name = (String) session.getAttribute("name");
    Boolean firstTimeLogin = (Boolean) session.getAttribute("firstTimeLogin");
    String lastLogin = (String) session.getAttribute("lastLogin"); 
    if (name == null) {
        response.sendRedirect("LoginQ3.jsp");
    }
%>
<div class="container">
    <h1>Welcome, <%= name %>!</h1>
    <% if (firstTimeLogin != null && firstTimeLogin) { %>
        <p>This is your first time logging in!</p>
    <% } else { %>
    <p class="info">Welcome back! We missed you!<br>Your last login was on: <%= lastLogin %></p>
    <% } %>
    <a href="logout.jsp">Logout</a> <!-- I have not created a logout.jsp page, so this leads nowhere-->
</div>
</body>
</html>

