<h1>Real LIFE BGC Scholarship Application System</h1>
<p><strong>Real LIFE Foundation</strong> is a faith-based nonprofit organization in the Philippines dedicated to serving and empowering underprivileged youth through educational assistance, character formation, and leadership development.</p>
<p>Real LIFE Foundation believes that education is the most effective way to empower individuals to lift themselves out of poverty. The organization provides comprehensive financial aid to scholars that goes beyond covering tuition and miscellaneous fees. The foundation also provides school-related expenses including supplies, uniforms, and other educational materials, ensuring scholars can comply with school requirements and excel in their academic projects. Weekly allowances are provided to cover transportation and meals, removing financial barriers that could hinder academic success.</p>
<p>The foundation empowers scholars by giving them the freedom to choose their preferred course strand or program, allowing senior high school and college students to develop their natural strengths and interests. This approach helps students pursue their passions while building the skills needed for future success.</p>

<div align="center">

  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-hero.png" alt="Hero Section" width="800">
  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-mission.png" alt="Mission" width="800">
  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-character-formation.png" alt="Character Formation" width="800">
  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-leadership.png" alt="Leadership Development" width="800">
  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-flow-1.png" alt="Leadership Development" width="800">
  <img src="https://github.com/yenashiloh/Real-Life-BGC/blob/main/public/assets/img/rl-flow-2.png" alt="Leadership Development" width="800">
  <br><br>
</div>

<h2>📋 <strong>PROJECT OVERVIEW</strong></h2>
<br>
This web-based scholarship application system was developed to streamline the scholarship application process for both students and administrators. The platform eliminates the need for physical documents and manual communication, making the entire process more efficient and accessible.
<h3><strong>MISSION</strong></h3>
<br>
To simplify the scholarship application process by:
<ul>
    <li>Enabling students to easily apply online and submit requirements digitally</li>
    <li>Allowing administrators to efficiently approve or decline applications</li>
    <li>Eliminating paperwork and physical document handling</li>
    <li>Automatic cloud storage of documents via Google Drive integration to optimize database storage</li>
    <li>Automating email notifications to keep applicants informed about their application status</li>
</ul>
<br>
<h2>🚀 <strong>FEATURES</strong></h2>
<h3><strong>For Students</strong></h3>
<ul>
    <li><strong>User Registration & Login</strong> - Secure account creation and authentication</li>
    <li><strong>Online Application Form</strong> - Comprehensive scholarship application with multiple sections</li>
    <li><strong>Document Upload</strong> - Digital submission of required documents and requirements</li>
    <li><strong>Application Status Tracking</strong> - Real-time monitoring of application progress</li>
    <li><strong>Automatic Email Notifications</strong> - Instant updates when application status changes</li>
</ul>
<br clear="all">
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
<br clear="all">
<h2>🛠️ <strong>TECHNOLOGY STACK</strong></h2>
<ul>
    <li><strong>Frontend:</strong> HTML5, CSS3, Bootstrap 5, JavaScript</li>
    <li><strong>Backend:</strong> Laravel (PHP Framework)</li>
    <li><strong>Database:</strong> MySQL</li>
    <li><strong>Cloud Storage:</strong> Google Drive API Integration</li>
    <li><strong>Server:</strong> Apache/Nginx compatible</li>
</ul>
<h2>📦 <strong>INSTALLATION</strong></h2>
<h3><strong>Prerequisites</strong></h3>
<ul>
    <li>PHP >= 8.0</li>
    <li>Composer</li>
    <li>MySQL >= 5.7</li>
    <li>Node.js & NPM (for asset compilation)</li>
</ul>
<h3><strong>Setup Instructions</strong></h3>
<strong>1. Clone the repository</strong>
<pre>
<code>
git clone https://github.com/yenashiloh/Real-Life-BGC.git
cd reallife-scholarship-system
</code>
</pre>
<strong>2. Install PHP dependencies</strong>
<pre>
<code>
composer install
</code>
</pre>
<strong>3. Install JavaScript dependencies</strong>
<pre>
<code>
npm install
</code>
</pre>
<strong>4. Environment Configuration</strong>
<pre>
<code>
cp .env.example .env
php artisan key:generate
</code>
</pre>
<strong>5. Configure your .env file</strong>
<pre>
<code>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reallife_scholarship
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

# Google Drive API Configuration
GOOGLE_DRIVE_CLIENT_ID=your_google_client_id
GOOGLE_DRIVE_CLIENT_SECRET=your_google_client_secret
GOOGLE_DRIVE_REFRESH_TOKEN=your_refresh_token
GOOGLE_DRIVE_FOLDER_ID=your_drive_folder_id
</code>
</pre>
<strong>6. Database Setup</strong>
<pre>
<code>
php artisan migrate
php artisan db:seed
</code>
</pre>
<strong>7. Compile Assets</strong>
<pre>
<code>
npm run dev
# or for production
npm run build
</code>
</pre>
<strong>8. Start the Server</strong>
<pre>
<code>
php artisan serve
</code>
</pre>
Visit <code>http://127.0.0.1:8000</code> to access the application.
<h2>📁 <strong>PROJECT STRUCTURE</strong></h2>
<pre>
<code>
reallife-scholarship-system/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Mail/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
└── storage/
</code>
</pre>

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

<h2>📝 <strong>LICENSE</strong></h2>
<p>This project is licensed under the MIT License - see the <a href="https://github.com/yenashiloh/Real-Life-BGC/blob/main/LICENSE.md">LICENSE.md</a> file for details.</p>
<h2>📞 <strong>CONTACT</strong></h2>
<ul>
    <li>Email: shiloheugenio21@gmail.com</li>
</ul>
<h2>🙏 <strong>ACKNOWLEDGEMENTS</strong></h2>
<ul>
    <li>All the dedicated volunteers and staff of Real LIFE Foundation</li>
    <li>The students and families who inspire our mission</li>
    <li>The development team who made this system possible</li>
</ul>
