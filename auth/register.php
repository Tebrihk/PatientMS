<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $full_name = trim($_POST['full_name'] ?? ''); // optional for now

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';

    // Check if email exists
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email is already registered.';
        }
    }

    // If valid ? insert user
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Handle file uploads
        $profilePicPath = null;
        if (!empty($_FILES['profile_pic']['name'])) {
            $ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
            $profilePicPath = 'uploads/profile_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], __DIR__ . '/../' . $profilePicPath);
        }

        $medicalRecordPath = null;
        if (!empty($_FILES['medical_record']['name'])) {
            $ext = pathinfo($_FILES['medical_record']['name'], PATHINFO_EXTENSION);
            $medicalRecordPath = 'uploads/record_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['medical_record']['tmp_name'], __DIR__ . '/../' . $medicalRecordPath);
        }

        // Insert into DB
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, profile_pic, medical_record, role) 
                               VALUES (?, ?, ?, ?, ?, 'patient')");
        $stmt->execute([$full_name, $email, $hash, $profilePicPath, $medicalRecordPath]);

        header('Location: login.php?registered=1');
        exit;
    }
}

include '../includes/header.php';
?>

<div class="alert alert-danger">
  <?php foreach ($errors as $err) echo "<div>$err</div>"; ?>
</div>
<a href="register.php" class="btn btn-secondary">Back</a>

<?php include '../includes/footer.php'; ?>
