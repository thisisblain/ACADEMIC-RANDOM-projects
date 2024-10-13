using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;
using System.Xml.Linq;
using System.Diagnostics.Eventing.Reader;
using System.Diagnostics.Contracts;
using System.IO;
using System.Net;


namespace PROGRAMMING_742_ASSIGNMENT_QUESTION_1_LMS
{
    // Delegate for Overdue Notifications
    public delegate void OverdueNotificationHandler(Member member, Book book);

    // Delegate for Report Generation
    public delegate void ReportGenerator(User user, TypeOfReport tor);





    //Start with abstract User Class
    public abstract class User
    {
        public int user_ID { get; set; }
        public string name { get; set; }
        public string email { get; set; }


        public abstract void Login();
        public abstract void Logout();


    }

    //Derived Member class
    public class Member : User
    {
        public List<Book> borrowed_books { get; set; } = new List<Book>();

        public override void Login()
        {
            Console.WriteLine($"{name} (Member) has logged in.");
        }

        public override void Logout()
        {
            Console.WriteLine($"{name} (Member) has logged out of the account.");
        }

        public void borrowBook(Book book, Library library)
        {
            if (!book.isBorrowed)
            {
                library.borrowBook(this, book.ISBN_NO);
            }

            else
            {
                Console.WriteLine($"{book.Title} has already been borrowed.");
            }
        }
        public void bookReturn(Book book, Library library)
        {
            library.bookReturn(this, book.ISBN_NO);
        }
        // Method to Subscribe to the Overdue notifications
        public void SubscribeToOverdueNotifications(Library library)
        {
            library.OnOverdueBook += NotifyOverdueBook;
        }

        // Event Handler for Overdue Notifications
        private void NotifyOverdueBook(Member member, Book book)
        {
            if (member.user_ID == this.user_ID)
            {
                Console.WriteLine($"*** Notification: {name}, your book '{book.Title}' is overdue! ***");
            }
        }
    }



    //Derived Class for the Librarian
    public class Librarian : User
    {
        public override void Login()
        {
            Console.WriteLine($"{name} (Librarian) has logged in.");
        }

        public override void Logout()
        {
            Console.WriteLine($"{name} (Librarian) has logged out.");
        }

        public void addBook(Book book, Library library)
        {

            try
            {
                library.addBook(book);
                Console.WriteLine($"{name} has added {book.Title}.");
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Error occured while adding book: {ex.Message}");

            }

        }

        public void removeBook(Book book, Library library)
        {
            try
            {
                library.removeBook(book);
                Console.WriteLine($"{name} has removed {book.Title} from the library!");
            }
            catch (Exception ex)
            {

                Console.WriteLine($"Error occured while removing book: {ex.Message}");
            }

        }
    }

    //Derived Admin Class
    public class Admin : User
    {
        public override void Login()
        {
            Console.WriteLine($"{name} (Admin) has logged in now.");
        }
        public override void Logout()
        {
            Console.WriteLine($"{name} (Admin) has now logged out.");
        }

        public void generateReport(TypeOfReport tor, Library library)
        {
            try
            {
                library.generateReport(tor, this);
            }
            catch (Exception ex)
            {

                Console.WriteLine($"Error occured while attempting to generate the report: {ex.Message}");
            }

        }
        // Subscribe to Report Generation
        public void SubscribeToReportGeneration(Library library)
        {
            library.OnGenerateReport += GenerateAdminReport;
        }

        //The Event Handler for generating the report
        private void GenerateAdminReport(User user, TypeOfReport reportType)
        {
            if (user is Admin admin && admin.user_ID == this.user_ID)
            {
                switch (reportType)
                {
                    case TypeOfReport.borrowed_books:
                        Console.WriteLine("\n[Admin Report] - Borrowed Books:");
                        foreach (var book in admin.Library.Books)
                        {
                            if (book.isBorrowed)
                                Console.WriteLine(book);
                        }
                        break;
                    case TypeOfReport.overdue_books:
                        Console.WriteLine("\n[Admin Report] - Overdue Books:");
                        foreach (var userItem in admin.Library.Users)
                        {
                            if (userItem is Member member)
                            {
                                foreach (var book in member.borrowed_books)
                                {
                                    Console.WriteLine($"{member.name} has overdue book: {book.Title}");
                                }
                            }
                        }
                        break;
                    case TypeOfReport.most_popular_books:
                        Console.WriteLine("\n[Admin Report] - Most Popular Books:");
                        var popularity = new Dictionary<string, int>();
                        foreach (var book in admin.Library.Books)
                        {
                            if (book.BorrowCounter > 0)
                            {
                                if (popularity.ContainsKey(book.Title))
                                    popularity[book.Title]++;
                                else
                                    popularity[book.Title] = 1;
                            }
                        }

                        foreach (var entry in popularity)
                        {
                            Console.WriteLine($"'{entry.Key}' has been borrowed {entry.Value} times.");
                        }
                        break;
                    default:
                        Console.WriteLine("Invalid report type.");
                        break;
                }
            }
        }
        // Reference to Library for accessing books in GenerateAdminReport
        public Library Library { get; set; }

    }
    //Now, for the actual Book class
    public class Book
    {
        public string Author { get; set; }
        public string Title { get; set; }
        public bool isBorrowed { get; set; } = false;
        public int BorrowCounter { get; set; } = 0; // To track popularity
        public string ISBN_NO { get; set; }
        public int PublicationYear { get; set; }

        public override string ToString()
        {
            return $"{Title} by {Author} (ISBN: {ISBN_NO}, Year: {PublicationYear})";
        }

    }
    //Configuring TypeOfReport Enum
    public enum TypeOfReport
    {
        borrowed_books,
        overdue_books,
        most_popular_books
    }

    //THE Library Class
    public class Library
    {   /*NB :Always use a dedicated private object for locking. Also, keep Locked sections as short as possible
        The Lock mechnism is used to ensure a block of code runs exclusively by one thread at a given time
        It is done to prevent data inconsistencies, like corrupted states and duplicate entries*/

        private readonly object _lock = new object();
        public List<Book> Books { get; set; } = new List<Book>();
        public List<User> Users { get; set; } = new List<User>();
        public string BooksFilePath { get; set; } = "books.txt";

        // Events
        public event OverdueNotificationHandler OnOverdueBook;
        public event ReportGenerator OnGenerateReport;

        //Method used for adding books
        public void addBook(Book book)
        {

            lock (_lock)
            {
                Books.Add(book);
                Console.WriteLine($"Book '{book.Title}' has successfully been added to the library!");
                saveBooksToFile();
            }

        }

        //Method used for removing books, called removeBook
        public void removeBook(Book book)
        {
            lock (_lock)
            {
                if (Books.Remove(book))
                {
                    Console.WriteLine($"Book '{book.Title}' has been removed from the library!");
                    saveBooksToFile();
                }
                else
                {
                    Console.WriteLine($"Book '{book.Title}' was not found in the library!");
                }
            }
        }

        //Method used to save the books to the file
        public void saveBooksToFile()
        {
            lock (_lock)
            {
                Console.WriteLine($"Saving {Books.Count} books to the file.");
                using (StreamWriter sw = new StreamWriter(BooksFilePath))
                {
                    foreach (var book in Books)
                    {
                        sw.WriteLine($"{book.Title}|{book.Author}|{book.ISBN_NO}|{book.PublicationYear}|{book.isBorrowed}|{book.BorrowCounter}");
                    }
                }
            }
        }

        //Method used for loading books from the file
        public void loadBooksFromFile()
        {

            try
            {
                if (File.Exists(BooksFilePath))
                {
                    using (StreamReader sr = new StreamReader(BooksFilePath))
                    {
                        string line;
                        while ((line = sr.ReadLine()) != null)
                        {
                            var sections = line.Split('|');
                            if (sections.Length == 6)
                            {
                                int publicationYear;
                                bool isBorrowed;
                                int borrowCount;

                                if (int.TryParse(sections[3], out publicationYear) &&
                                    bool.TryParse(sections[4], out isBorrowed) &&
                                    int.TryParse(sections[5], out borrowCount))
                                {
                                    Books.Add(new Book
                                    {
                                        Title = sections[0],
                                        Author = sections[1],
                                        ISBN_NO = sections[2],
                                        PublicationYear = publicationYear,
                                        isBorrowed = isBorrowed,
                                        BorrowCounter = borrowCount
                                    });
                                }
                                else
                                {
                                    Console.WriteLine("Invalid data format in books.txt.");
                                }
                            }
                        }
                    }
                    Console.WriteLine($"Loaded {Books.Count} books from file.");
                }
                else
                {
                    Console.WriteLine("books.txt  has not been found. Starting with an empty library.");
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Error occured while loading books: {ex.Message}");
            }
        }
        //Method used for Members borrowing books

        public bool borrowBook(Member member, string isbn)
        {

            lock (_lock)
            {
                Book book = Books.Find(b => b.ISBN_NO == isbn);
                if (book != null && !book.isBorrowed)
                {
                    book.isBorrowed = true;
                    book.BorrowCounter++;
                    member.borrowed_books.Add(book);
                    Console.WriteLine($"{member.name} has borrowed {book.Title}.");
                    return true;

                }
                else
                {
                    Console.WriteLine($"{member.name} could not borrow book with ISBN No: {isbn} this time.");
                    return false;
                }
            }

        }
        //Method used for Returning the Book
        public bool bookReturn(Member member, string isbn)
        {
            lock (_lock)
            {
                Book book = member.borrowed_books.Find(b => b.ISBN_NO == isbn);
                if (book != null)
                {
                    book.isBorrowed = false;
                    member.borrowed_books.Remove(book);
                    Console.WriteLine($"{member.name} has returned {book.Title} successfully.");
                    saveBooksToFile();
                    return true;

                }
                else
                {
                    Console.WriteLine($"{member.name} does not currently have the book with ISBN no: {isbn}.");
                    return false;
                }
            }

        }


        public void generateReport(TypeOfReport tor, User user)
        {

            OnGenerateReport?.Invoke(user, tor);
        }

        // Method to check overdue books and notify members
        public void CheckOverdueBooks()
        {
            // Here, we are assuming all books are overdue
            foreach (var user in Users)
            {
                if (user is Member member)
                {
                    foreach (var book in member.borrowed_books)
                    {
                        // Trigger the overdue notification event
                        OnOverdueBook?.Invoke(member, book);
                    }
                }
            }
        }
    }

    class Program
    {

        static void Main(string[] args)
        {
            try
            {
                Console.WriteLine($"Current Directory: {Directory.GetCurrentDirectory()}");
                Library library = new Library();
                library.loadBooksFromFile();

                // Create Users
                Admin admin = new Admin { user_ID = 100, name = "John Marston", email = "john.marston@rdr.com" };
                Member member = new Member { user_ID = 101, name = "Arthur Morgan", email = "arthur.morgan@yahoo.com" };
                Librarian librarian = new Librarian { user_ID = 301, name = "Blain Holland", email = "blain.holland@library.com" };

                // Adding the Users to Library
                library.Users.Add(admin);
                library.Users.Add(member);
                library.Users.Add(librarian);

                // Subscribe Members and Admin to Events
                member.SubscribeToOverdueNotifications(library);
                admin.SubscribeToReportGeneration(library);
                admin.Library = library; // Assigning the library reference for report access

                // Creating the interactive Main Menu,,
                bool exit = false;
                while (!exit)
                {
                    Console.WriteLine("\n--- Library Management System ---");
                    Console.WriteLine("\n-------------------------------------");

                    Console.WriteLine("Select your role:");
                    Console.WriteLine("1. Admin");
                    Console.WriteLine("2. Librarian");
                    Console.WriteLine("3. Member");
                    Console.WriteLine("4. Exit");
                    Console.Write("Enter your choice: ");
                    string roleOption = Console.ReadLine();

                    switch (roleOption)
                    {
                        case "1":
                            AdminMenu(admin, library);
                            break;
                        case "2":
                            LibrarianMenu(librarian, library);
                            break;
                        case "3":
                            MemberMenu(member, library);
                            break;
                        case "4":
                            exit = true;
                            Console.WriteLine("Exiting the system. Enjoy the rest of your day!");
                            break;
                        default:
                            Console.WriteLine("Invalid selection has been made, please enter a number from 1 - 4.");
                            break;
                    }
                }
            }
            catch (Exception ex)
            {
                Console.WriteLine($"\nAn unexpected error has occurred: {ex.Message}");
            }

            Console.WriteLine("\nPress Enter to exit.");
            Console.ReadLine(); // Keeps the console window open
        }

        //The Admin Menu
        static void AdminMenu(Admin admin, Library library)
        {
            Console.WriteLine("\n--- Admin Menu ---");
            admin.Login();
            bool back = false;
            while (!back)
            {
                Console.WriteLine("\nSelect an option:");
                Console.WriteLine("1. Generate a Bprrowed Books Report");
                Console.WriteLine("2. Generate an Overdue Books Report");
                Console.WriteLine("3. Generate a Most Popular Books Report");
                Console.WriteLine("4. Return to the main menu");
                Console.WriteLine("Please enter your choice: ");
                string adminOption = Console.ReadLine();

                switch (adminOption)
                {

                    case "1":
                        admin.generateReport(TypeOfReport.borrowed_books, library);
                        break;
                    case "2":
                        admin.generateReport(TypeOfReport.overdue_books, library);
                        break;
                    case "3":
                        admin.generateReport(TypeOfReport.most_popular_books, library);
                        break;
                    case "4":
                        back = true;
                        admin.Logout();
                        break;
                    default:
                        Console.WriteLine("Invalid selection has been made, please enter a number from 1 - 4.");
                        break;
                }

            }

        }
        // Librarian Menu
        static void LibrarianMenu(Librarian librarian, Library library)
        {
            Console.WriteLine("\n--- Librarian Menu ---");
            librarian.Login();
            bool back = false;
            while (!back)
            {
                Console.WriteLine("\nSelect an option:");
                Console.WriteLine("1. Add Book");
                Console.WriteLine("2. Remove Book");
                Console.WriteLine("3. Back to Main Menu");
                Console.Write("Enter choice: ");
                string libChoice = Console.ReadLine();

                switch (libChoice)
                {
                    case "1":
                        AddBookFlow(librarian, library);
                        break;
                    case "2":
                        RemoveBookFlow(librarian, library);
                        break;
                    case "3":
                        back = true;
                        librarian.Logout();
                        break;
                    default:
                        Console.WriteLine("Invalid selection has been made, please enter a number from 1 - 3.");
                        break;
                }
            }
        }

        //Member Menu

        static void MemberMenu(Member member, Library library)
        {
            Console.WriteLine("\n--- Member Menu ---");
            member.Login();
            bool goingBack = false;

            while (!goingBack)
            {
                Console.WriteLine("\nSelect an option:");
                Console.WriteLine("1. Borrow Book");
                Console.WriteLine("2. Return Book");
                Console.WriteLine("3. View Borrowed Books");
                Console.WriteLine("4. Back to Main Menu");
                Console.Write("Please Enter choice: ");
                string memberChoice = Console.ReadLine();

                switch (memberChoice)
                {
                    case "1":
                        BorrowBookFlow(member, library);
                        break;
                    case "2":
                        ReturnBookFlow(member, library);
                        break;
                    case "3":
                        ViewBorrowedBooks(member);
                        break;
                    case "4":
                        goingBack = true;
                        member.Logout();
                        break;
                    default:
                        Console.WriteLine("Invalid selection has been made, please enter a number from 1 - 4.");
                        break;
                }
            }
        }

        // Flow to Add Book
        static void AddBookFlow(Librarian librarian, Library library)
        {
            Console.Write("\nEnter the Book Title: ");
            string title = Console.ReadLine();

            Console.Write("Enter Book Author: ");
            string author = Console.ReadLine();

            Console.Write("Enter Book ISBN Number: ");
            string isbn = Console.ReadLine();

            Console.Write("Enter Publication Year: ");
            string yearInput = Console.ReadLine();
            int publicationYear;
            while (!int.TryParse(yearInput, out publicationYear))
            {
                Console.Write("Invalid input. Enter a valid Publication Year: ");
                yearInput = Console.ReadLine();
            }

            Book newBook = new Book
            {
                Title = title,
                Author = author,
                ISBN_NO = isbn,
                PublicationYear = publicationYear
            };

            librarian.addBook(newBook, library);
        }

        // Flow to Remove Book
        static void RemoveBookFlow(Librarian librarian, Library library)
        {
            Console.Write("\nEnter Book Title to Remove it: ");
            string title = Console.ReadLine();

            Book book = library.Books.Find(b => b.Title == title);
            if (book != null)
            {
                librarian.removeBook(book, library);
            }
            else
            {
                Console.WriteLine($"No book found with Title: {title}");
            }
        }

        // Flow to Borrow Book
        static void BorrowBookFlow(Member member, Library library)
        {
            Console.Write("\nEnter Book Title to Borrow it: ");
            string title = Console.ReadLine();

            Book book = library.Books.Find(b => b.Title == title);
            if (book != null)
            {
                member.borrowBook(book, library);
            }
            else
            {
                Console.WriteLine($"No book found with Title: {title}");
            }
        }

        // Flow to Return Book
        static void ReturnBookFlow(Member member, Library library)
        {
            Console.Write("\nEnter Book Title to Return it: ");
            string title = Console.ReadLine();

            Book book = member.borrowed_books.Find(b => b.Title == title);
            if (book != null)
            {
                member.bookReturn(book, library);
            }
            else
            {
                Console.WriteLine($"You do not have a book with Title: {title}");
            }
        }

        // Flow to View Borrowed Books
        static void ViewBorrowedBooks(Member member)
        {
            Console.WriteLine("\n--- List of Borrowed Books ---");
            if (member.borrowed_books.Count > 0)
            {
                foreach (var book in member.borrowed_books)
                {
                    Console.WriteLine(book);
                }
            }
            else
            {
                Console.WriteLine("You have not borrowed any books!");
            }
        }
    }
}




/* Initializing the Library
Library library = new Library();
library.loadBooksFromFile();

// Create a Librarian onject
Librarian librarian = new Librarian
{
    user_ID = 10,
    name = "Blain Holland",
    email = "blain.holland@library.com"
};

//The  Librarian logs in using the Login method
librarian.Login();

// Create a new Book object with details of the book
Book newBook = new Book
{
    Title = "The Art of Seduction",
    Author = "Robert Greene",
    ISBN_NO = "978-0670891924",
    PublicationYear = 2001
};

// Librarian adds the new books to the Library
librarian.addBook(newBook, library);

// Saving the updated library to file
library.saveBooksToFile();

//The Librarian logs out by calling the logout method
librarian.Logout();

Console.WriteLine("Book has been added and saved successfully!");


Console.WriteLine("Press any key to exit.");
Console.ReadKey();
}
}


}  
*/







