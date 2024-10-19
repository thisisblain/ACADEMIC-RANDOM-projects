
import jakarta.servlet.RequestDispatcher; 
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
/**
 *
 * @author Blain Holland
 */
@WebServlet(urlPatterns = {"/RegistrationServlet"})
public class RegistrationServlet extends HttpServlet {
 @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Forward to registration JSP when accessed via a GET request
        request.getRequestDispatcher("RegistrationQ3.jsp").forward(request, response);
    }
  
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        // processRequest(request, response);
       response.setContentType("text/html");
      
       
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        String name = request.getParameter("name");
        
         Connection con = null;
        PreparedStatement ps = null;
       
        try {
            //handling the database

            Class.forName("com.mysql.cj.jdbc.Driver");
            
            //Getting the connection. Be sure to include neccessary libraries above!
            
            con = DriverManager.getConnection("jdbc:mysql://localhost:3306/users", "root", "rugerobl52");
            ps = con.prepareStatement("insert into user_credentials (username, password, name) values(?,?,?)");
            ps.setString(1, username);
            ps.setString(2, password);
            ps.setString(3, name);
           
            //Executing the updates
            int result = ps.executeUpdate();
            
     //Verifying if the insertion has been successful or not
    if (result > 0) {
    // Store a success message in the session scope
    request.getSession().setAttribute("message", "Registration successful! Please log in.");
    response.sendRedirect("LoginQ3.jsp");
} else {
        
     // If insertion failed, set an error message
    request.setAttribute("message", "Error occurred while updating the database! Please try again.");
    request.getRequestDispatcher("RegistrationQ3.jsp").forward(request, response);
}
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(RegistrationServlet.class.getName()).log(Level.SEVERE, null, ex);
            // Set an error message and forward it back to the RegistrationQ3.jsp page
            request.setAttribute("message", "Database error: " + ex.getMessage());
            request.getRequestDispatcher("RegistrationQ3.jsp").forward(request, response);
        } finally {
            // Close the  resources
            try {
                if (ps != null) ps.close();
                if (con != null) con.close();
            } catch (SQLException ex) {
                Logger.getLogger(RegistrationServlet.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }

    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
