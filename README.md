# 🔍 Lost and Found Management System

A web-based Lost and Found Items Management System built as a Database Systems (DBMS) course project. The system allows users to report, search, and manage lost or found items through a structured web interface, with separate dashboards for users and administrators.

---

## 📌 Features

### 👤 User
- Register and securely log in to the system
- Report lost or found items with full details
- View, update, and delete personal item reports
- Search for items using keywords or filters
- Manage personal profile information
- Claim found items

### 🛡️ Admin
- View all items reported by users
- Update item statuses
- Delete item reports
- Manage and organize all records in the system

---

## 🌐 Pages

| # | Page | Description |
|---|---|---|
| 1 | Home (Index) | Welcome page with links to register or login |
| 2 | Register | New user account creation |
| 3 | Login | Login page for users and admin |
| 4 | User Dashboard | Main hub for users to manage items and profile |
| 5 | Admin Dashboard | Admin panel for managing all reports |
| 6 | User Profile | View and update personal information |
| 7 | Add Item | Form to report a lost or found item |
| 8 | View Item | List of items reported by user or all items (admin) |
| 9 | Search Item | Search with filters to find matching items |
| 10 | Delete Item | Confirmation and deletion of an item report |
| 11 | Update Item | Update details of an existing item report |
| 12 | Contact Us | Contact form and support information |
| 13 | About | Information about the system and its purpose |

---

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| HTML | Page structure and layout |
| CSS | Styling and design |
| PHP | Backend logic and database connection |
| MySQL | Database for storing users and items |
| XAMPP | Local server environment |

---

## 🚀 How to Run

1. Clone the repository:
   ```
   git clone https://github.com/Urwa45/Lost-and-Found-Management-System.git
   ```
2. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**
3. Copy the project folder to `C:\xampp\htdocs\`
4. Open **phpMyAdmin** at `http://localhost/phpmyadmin` and import the `.sql` database file
5. Open your browser and go to `http://localhost/Lost-and-Found-Management-System`

---

## 📁 Project Structure

```
Lost-and-Found-Management-System/
│
├── index.php              # Home page
├── register.php           # Registration page
├── login.php              # Login page
├── user_dashboard.php     # User dashboard
├── admin_dashboard.php    # Admin dashboard
├── user_profile.php       # User profile page
├── add_item.php           # Add item form
├── view_item.php          # View items page
├── search_item.php        # Search page
├── delete_item.php        # Delete item page
├── update_item.php        # Update item page
├── contact.php            # Contact us page
├── about.php              # About page
├── css/                   # Stylesheets
└── database/              # SQL database file
```

---

## 📚 Course

**Database Systems (DBMS) Lab Project**
University of Management and Technology, Lahore

---

## 👩‍💻 Developer

**Urwa Manzoor**
BS Computer Science — University of Management and Technology
[LinkedIn](https://www.linkedin.com/in/urwa-manzoor)
