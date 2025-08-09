<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real LIFE Foundation Scholarship Application System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        h1 {
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #34495e;
            margin-top: 30px;
        }
        ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        li {
            margin: 8px 0;
        }
        .feature-section {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin: 15px 0;
        }
        .tech-stack {
            background: #e8f6f3;
            padding: 15px;
            border-radius: 5px;
        }
        code {
            background: #f1f2f6;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
        .installation-step {
            background: #fff3cd;
            padding: 10px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Real LIFE Foundation Scholarship Application System</h1>
        
        <p><strong>Real LIFE Foundation</strong> is a faith-based nonprofit organization in the Philippines dedicated to serving and empowering underprivileged youth through educational assistance, character formation, and leadership development.</p>

        <h2>📋 <strong>PROJECT OVERVIEW</strong></h2>
        <br>
        <p>This web-based scholarship application system was developed to streamline the scholarship application process for both students and administrators. The platform eliminates the need for physical documents and manual communication, making the entire process more efficient and accessible.</p>

        <h3><strong>MISSION</strong></h3>
        <br>
        <p>To simplify the scholarship application process by:</p>
        <ul>
            <li>Enabling students to easily apply online and submit requirements digitally</li>
            <li>Allowing administrators to efficiently approve or decline applications</li>
            <li>Eliminating paperwork and physical document handling</li>
            <li>Automatic cloud storage of documents via Google Drive integration to optimize database storage</li>
            <li>Automating email notifications to keep applicants informed about their application status</li>
        </ul>
        <br>

        <h2>🚀 <strong>FEATURES</strong></h2>
        
        <div class="feature-section">
            <h3><strong>For Students</strong></h3>
            <ul>
                <li><strong>User Registration & Login</strong> - Secure account creation and authentication</li>
                <li><strong>Online Application Form</strong> - Comprehensive scholarship application with multiple sections</li>
                <li><strong>Document Upload</strong> - Digital submission of required documents and requirements</li>
                <li><strong>Application Status Tracking</strong> - Real-time monitoring of application progress</li>
                <li><strong>Automatic Email Notifications</strong> - Instant updates when application status changes</li>
            </ul>
        </div>

        <div class="feature-section">
            <h3><strong>For Administrators</strong></h3>
            <ul>
                <li><strong>Admin Dashboard</strong> - Centralized management interface</li>
                <li><strong>Application Management</strong> - Review, approve, or decline student applications</li>
                <li><strong>Search & Filter</strong> - Advanced filtering to find specific applications quickly</li>
                <li><strong>Document Review</strong> - Online viewing and verification of submitted documents</li>
                <li><strong>Status Management</strong> - Easy updating of application statuses with automatic notifications</li>
                <li><strong>Google Drive Integration</strong> - Automatic upload of student documents to Google Drive for cloud storage</li>
                <li><strong>Admin Account Management</strong> - Create and manage additional administrator accounts</li>
            </ul>
        </div>

        <h2>🛠️ <strong>TECHNOLOGY STACK</strong></h2>
        <div class="tech-stack">
            <ul>
                <li><strong>Frontend:</strong> HTML5, CSS3, Bootstrap 5, JavaScript</li>
                <li><strong>Backend:</strong> Laravel (PHP Framework)</li>
                <li><strong>Database:</strong> MySQL</li>
                <li><strong>Cloud Storage:</strong> Google Drive API Integration</li>
                <li><strong>Server:</strong> Apache/Nginx compatible</li>
            </ul>
        </div>

        <h2>📦 <strong>INSTALLATION</strong></h2>
        
        <h3><strong>Prerequisites</strong></h3>
        <ul>
            <li>PHP >= 8.0</li>
            <li>Composer</li>
            <li>MySQL >= 5.7</li>
            <li>Node.js & NPM (for asset compilation)</li>
        </ul>

        <h3><strong>Setup Instructions</strong></h3>
        
        <div class="installation-step">
            <p><strong>1. Clone the repository</strong></p>
            <code>git clone https://github.com/yourusername/reallife-scholarship-system.git<br>
            cd reallife-scholarship-system</code>
        </div>

        <div class="installation-step">
            <p><strong>2. Install PHP dependencies</strong></p>
            <code>composer install</code>
        </div>

        <div class="installation-step">
            <p><strong>3. Install JavaScript dependencies</strong></p>
            <code>npm install</code>
        </div>

        <div class="installation-step">
            <p><strong>4. Environment Configuration</strong></p>
            <code>cp .env.example .env<br>
            php artisan key:generate</code>
        </div>

        <div class="installation-step">
            <p><strong>5. Configure your .env file</strong></p>
            <code>
                DB_CONNECTION=mysql<br>
                DB_HOST=127.0.0.1<br>
                DB_PORT=3306<br>
                DB_DATABASE=reallife_scholarship<br>
                DB_USERNAME=your_username<br>
                DB_PASSWORD=your_password<br><br>
                
                MAIL_MAILER=smtp<br>
                MAIL_HOST=your_smtp_host<br>
                MAIL_PORT=587<br>
                MAIL_USERNAME=your_email<br>
                MAIL_PASSWORD=your_password<br>
                MAIL_ENCRYPTION=tls<br><br>
                
                # Google Drive API Configuration<br>
                GOOGLE_DRIVE_CLIENT_ID=your_google_client_id<br>
                GOOGLE_DRIVE_CLIENT_SECRET=your_google_client_secret<br>
                GOOGLE_DRIVE_REFRESH_TOKEN=your_refresh_token<br>
                GOOGLE_DRIVE_FOLDER_ID=your_drive_folder_id
            </code>
        </div>

        <div class="installation-step">
            <p><strong>6. Database Setup</strong></p>
            <code>php artisan migrate<br>
            php artisan db:seed</code>
        </div>

        <div class="installation-step">
            <p><strong>7. Compile Assets</strong></p>
            <code>npm run dev<br>
            # or for production<br>
            npm run build</code>
        </div>

        <div class="installation-step">
            <p><strong>8. Start the Server</strong></p>
            <code>php artisan serve</code>
            <p>Visit <code>http://localhost:8000</code> to access the application.</p>
        </div>

        <h2>🎯 <strong>USAGE</strong></h2>
        
        <h3><strong>For Students</strong></h3>
        <ul>
            <li><strong>Register</strong> for a new account or <strong>Login</strong> with existing credentials</li>
            <li><strong>Complete</strong> the scholarship application form</li>
            <li><strong>Upload</strong> all required documents (ID, grades, certificates, etc.)</li>
            <li><strong>Submit</strong> your application</li>
            <li><strong>Track</strong> your application status and receive email updates</li>
        </ul>

        <h3><strong>For Administrators</strong></h3>
        <ul>
            <li><strong>Login</strong> to the admin dashboard</li>
            <li><strong>Review</strong> submitted applications</li>
            <li><strong>Download/View</strong> student documents</li>
            <li><strong>Update</strong> application status (Pending/Approved/Declined)</li>
            <li><strong>Use search/filter</strong> to manage applications efficiently</li>
            <li><strong>Create new admin accounts</strong> for additional staff members</li>
            <li><strong>Manage admin user permissions</strong> and access levels</li>
        </ul>

        <h2>📧 <strong>EMAIL NOTIFICATIONS</strong></h2>
        <p>The system automatically sends email notifications to students when:</p>
        <ul>
            <li>Application is successfully submitted</li>
            <li>Application status is changed by admin</li>
            <li>Additional documents are required</li>
            <li>Scholarship decision is finalized</li>
        </ul>

        <h2>🔒 <strong>SECURITY FEATURES</strong></h2>
        <ul>
            <li>Password hashing and secure authentication</li>
            <li>CSRF protection</li>
            <li>File upload validation and security</li>
            <li>Role-based access control (Admin vs Student roles)</li>
            <li>Admin account creation permissions</li>
            <li>Secure session management</li>
            <li>Google Drive API secure authentication</li>
            <li>Encrypted file storage in cloud</li>
        </ul>

        <h2>🤝 <strong>CONTRIBUTING</strong></h2>
        <ul>
            <li>Fork the repository</li>
            <li>Create a feature branch (<code>git checkout -b feature/AmazingFeature</code>)</li>
            <li>Commit your changes (<code>git commit -m 'Add some AmazingFeature'</code>)</li>
            <li>Push to the branch (<code>git push origin feature/AmazingFeature</code>)</li>
            <li>Open a Pull Request</li>
        </ul>

        <h2>📝 <strong>LICENSE</strong></h2>
        <p>This project is licensed under the MIT License - see the <a href="LICENSE.md">LICENSE.md</a> file for details.</p>

        <h2>📞 <strong>CONTACT</strong></h2>
        <p><strong>Real LIFE Foundation</strong></p>
        <ul>
            <li>Website: <a href="http://reallifefoundation.org">reallifefoundation.org</a></li>
            <li>Email: info@reallifefoundation.org</li>
            <li>Phone: +63 XXX XXX XXXX</li>
        </ul>

        <h2>🙏 <strong>ACKNOWLEDGEMENTS</strong></h2>
        <ul>
            <li>All the dedicated volunteers and staff of Real LIFE Foundation</li>
            <li>The students and families who inspire our mission</li>
            <li>The development team who made this system possible</li>
        </ul>

        <hr>
        <p style="text-align: center;"><strong>Empowering Youth Through Education</strong> 🎓</p>
    </div>
</body>
</html>
