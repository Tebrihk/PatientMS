<?php
// config.php
declare(strict_types=1);


session_start();


// DB settings
define('DB_HOST','127.0.0.1');
define('DB_NAME','patient_mgmt');
define('DB_USER','root');
define('DB_PASS',''); // XAMPP default


define('BASE_URL','http://localhost/patient-management');


define('UPLOAD_DIR', __DIR__ . '/../assets/uploads');


define('PROFILE_DIR', UPLOAD_DIR . '/profiles');


define('DOC_DIR', UPLOAD_DIR . '/documents');


try {
$pdo = new PDO(
'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
DB_USER,
DB_PASS,
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
} catch (PDOException $e) {
die('DB Connection failed: ' . $e->getMessage());
}


// Create upload dirs if not exist
if (!is_dir(PROFILE_DIR)) mkdir(PROFILE_DIR, 0755, true);
if (!is_dir(DOC_DIR)) mkdir(DOC_DIR, 0755, true);


// Email from address
define('MAIL_FROM', 'no-reply@local.dev');