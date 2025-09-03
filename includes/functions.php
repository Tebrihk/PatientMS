<?php
// functions.php
require_once __DIR__ . '/config.php';


function esc($s){ return htmlspecialchars((string)$s, ENT_QUOTES); }


function is_logged_in(){ return !empty($_SESSION['user_id']); }
function current_user_id(){ return $_SESSION['user_id'] ?? null; }
function current_user(){ global $pdo; if(!is_logged_in()) return null; $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?'); $stmt->execute([current_user_id()]); return $stmt->fetch(PDO::FETCH_ASSOC); }


function send_mail($to, $subject, $message){
$headers = 'From: ' . MAIL_FROM . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";
return mail($to, $subject, $message, $headers);
}


// Generate token: e.g. DOC<doctorid>-YYYYMMDD-<n>
function generate_token_for_appointment(PDO $pdo, int $doctor_id, string $date){
// Count existing tokens for that doctor and date
$stmt = $pdo->prepare('SELECT COUNT(*) as c FROM appointments WHERE doctor_id = ? AND appointment_date = ?');
$stmt->execute([$doctor_id, $date]);
$count = (int)$stmt->fetchColumn();
$num = $count + 1;
$token = sprintf('D%03d-%s-%02d', $doctor_id, date('Ymd', strtotime($date)), $num);
return $token;
}