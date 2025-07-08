> ⚠️ **Note:** This project was built as an early exploration when I began coding in 2016. It does not represent my current development standards or best practices. Please review the code with that historical context in mind.

# Diagnosis Assistant Management System (DAMS)

## Overview

DAMS (Diagnosis Assistant Management System) is a web-based platform designed to streamline the management of diagnostic centers, clinics, labs, pharmacies, and healthcare professionals. It provides a comprehensive solution for handling appointments, tests, prescriptions, user management, notifications, and messaging between clients, partners (doctors, labs, pharmacies), and administrators.

## Features
- User registration and authentication for clients, partners, and admins
- Appointment booking and management for tests and doctor visits
- Pharmacy and drug ordering (including prescription uploads)
- Messaging and notification system
- Admin dashboard for managing users, partners, and content
- Email verification and notifications
- Role-based access (Admin, Partner, Client)

## Database Schema
The system uses a MySQL database. The main tables include:

- **admin**: Stores admin user details
- **appointments**: Manages appointment requests and statuses
- **available_tests**: Lists diagnostic tests offered by partners
- **branches**: Contains branch information for partners
- **category**: Categories for tests (e.g., blood test)
- **clients**: Stores client (patient) information
- **drugs**: Drug inventory for pharmacies
- **drugs_ordered**: Records of drug orders by clients
- **emails**: Outgoing email logs
- **messages**: Internal messaging between users
- **notifications**: System notifications for users
- **packages**: Subscription packages for partners
- **partners**: Information about partner organizations (labs, doctors, pharmacies)
- **posts**: Admin posts/announcements
- **premium**: Premium package subscriptions
- **prescriptions**: Uploaded prescription images for pharmacy orders
- **tests**: Master list of diagnostic tests
- **verification**: Verification records for partners

Refer to `dams.sql` for the full schema and sample data.

## Code Structure
- `index.php`: Redirects to the main home page
- `home/`: Public-facing site for clients (patients)
  - `index.php`: Main landing page
  - `server/Home.php`: Backend logic for client operations
- `dashboard/admin/`: Admin dashboard
  - `server/Admin.php`: Backend logic for admin operations
  - `parts/`: Includes for CSS, JS, and UI components
- `login/`: Login and registration for different user roles
- `mailer/`: Email sending functionality (uses PHPMailer)
- `gallery/`: Stores images for profiles, prescriptions, certificates, etc.

## Security Considerations
- **Authentication**: Session-based authentication for all user roles
- **Password Storage**: Passwords are stored as plain text in the current implementation. **It is strongly recommended to use password hashing (e.g., bcrypt) in production.**
- **Input Validation**: Basic validation is present, but further sanitization and prepared statements should be implemented to prevent SQL injection.
- **File Uploads**: Uploaded files (profile pictures, prescriptions) are checked for name collisions but should also be validated for type and size.
- **Email Verification**: Email verification is required for new users and partners.
- **Role-based Access**: Admin, partner, and client areas are separated by session checks.
- **Sensitive Data**: SMTP credentials and other sensitive data are hardcoded. **Move these to environment variables or configuration files in production.**

## Setup Instructions

### Prerequisites
- PHP 7.4+
- MySQL/MariaDB
- Apache/Nginx web server
- Composer (for PHPMailer dependencies, if needed)

### Installation
1. **Clone the repository**
2. **Database Setup**:
   - Import `dams.sql` into your MySQL server:
     ```
     mysql -u root -p dams < dams.sql
     ```
   - Update database credentials in all PHP files that connect to MySQL (search for `new mysqli('localhost', 'root', '', 'dams')`)
3. **Configure Mailer**:
   - Update SMTP credentials in `mailer/` and related PHP files
4. **Set File Permissions**:
   - Ensure `gallery/` and its subfolders are writable for file uploads
5. **Web Server Setup**:
   - Point your web server's document root to the project directory
   - Enable URL rewriting if needed
6. **Access the Application**:
   - Visit `http://localhost/dams/` in your browser

### Default Admin Login
- Username: `admin`
- Password: `123456`

## Recommendations for Production
- Use HTTPS
- Implement password hashing and stronger validation
- Move sensitive credentials to environment variables
- Regularly update dependencies and patch security vulnerabilities
- Limit file upload types and sizes

## License
This project is for educational and demonstration purposes. For production use, review and enhance security, privacy, and compliance measures. 