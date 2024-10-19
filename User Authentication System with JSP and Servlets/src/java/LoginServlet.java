
import jakarta.servlet.RequestDispatcher;
import java.sql.Connection;
import java.sql.*;
import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;
import java.sql.SQLException;

/**
 *
 * @author Blain Holland
 */
@WebServlet(urlPatterns = {"/LoginServlet"})
public class LoginServlet extends HttpServlet {
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Forward to login JSP when accessed via a GET request
        request.getRequestDispatcher("LoginQ3.jsp").forward(request, response);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        
        Connection con = null;
        PreparedStatement ps = null;
        ResultSet resSet = null;
        
        
        try {
            
            //loading the JDBC Driver & handling the database

            Class.forName("com.mysql.cj.jdbc.Driver");
            
            //Getting the connection to the database. password has been omitted for obvious reasons
            con = DriverManager.getConnection("jdbc:mysql://localhost:3306/users","root","rugerobl52");
            String query = "SELECT * FROM user_credentials WHERE username = ? AND password = ?";
            ps = con.prepareStatement(query);
            ps.setString(1, username);
            ps.setString(2, password);
          
           
            resSet = ps.executeQuery();
            
            
           if (resSet.next()) {
                HttpSession session = request.getSession();
                session.setAttribute("username", username);
                session.setAttribute("name", resSet.getString("name"));
                session.setAttribute("firstTimeLogin", resSet.getBoolean("first_time_login"));
 
                //Update first time login status as well as the last time the user has logged in
                // Fetch and format last login time
                String lastLogin = resSet.getString("last_login");
                session.setAttribute("lastLogin", lastLogin != null ? lastLogin : "Unknown");

                String updateQuery = resSet.getBoolean("first_time_login") ?
                    "UPDATE user_credentials SET first_time_login = false, last_login = NOW() WHERE username = ?" :
                    "UPDATE user_credentials SET last_login = NOW() WHERE username = ?";
                
                //Executing the update query
                ps = con.prepareStatement(updateQuery);
                ps.setString(1, username);
                ps.executeUpdate();
                
                //Redirect to the welcome page
                response.sendRedirect("Welcome.jsp");
            } else {
               //IF the login credentials are WRONG, show error messages
                request.setAttribute("error", "Invalid username or password has been inserted.");
                RequestDispatcher rd = request.getRequestDispatcher("LoginQ3.jsp");
                rd.forward(request, response);
            }
        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
            
            // Log the error. Also, set an appropriate error message
            request.setAttribute("error", "Login has been unsuccessful due to a database error. Please try again, or consider Registration!!");
            RequestDispatcher rd = request.getRequestDispatcher("LoginQ3.jsp");
            rd.forward(request, response);
        } finally {
            // Close all database resources
            try {
                if (resSet != null) resSet.close();
                if (ps != null) ps.close();
                if (con != null) con.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }
    

 
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
