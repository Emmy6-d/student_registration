<?php

require_once "config.php";
require_once "auth.php";

require_login();
$studentRecordId = current_student_record_id();

try {
    $stmt = $pdo->prepare("SELECT student_id, name, age, gender, class, contact, email, created_at FROM students WHERE id = :id");
    $stmt->execute([":id" => $studentRecordId]);
    $student = $stmt->fetch();

    if (!$student) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    $student = null;
    $error = "Unable to retrieve your account information.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Bluebridge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div class="brand-wrap"><div class="brand-mark">B</div><h1>Bluebridge Student Hub</h1></div>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register Student</a>
            <a href="list.php">View Students</a>
            <a href="account.php" class="active">My Account</a>
            <a href="logout.php">Sign Out</a>
        </nav>
    </header>

    <main class="card account-card">
        <div class="eyebrow">PRIVATE STUDENT ACCOUNT</div>
        <h2>Welcome, <?= htmlspecialchars($student["name"] ?? "Student") ?></h2>
        <?php if (!empty($error)): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($student): ?>
            <p class="intro">Your complete registration information is available only after signing in.</p>
            <dl class="account-details">
                <div><dt>Student ID</dt><dd><?= htmlspecialchars($student["student_id"]) ?></dd></div>
                <div><dt>Name</dt><dd><?= htmlspecialchars($student["name"]) ?></dd></div>
                <div><dt>Age</dt><dd><?= htmlspecialchars($student["age"]) ?></dd></div>
                <div><dt>Gender</dt><dd><?= htmlspecialchars($student["gender"] ?? "Not provided") ?></dd></div>
                <div><dt>Class</dt><dd><?= htmlspecialchars($student["class"]) ?></dd></div>
                <div><dt>Contact</dt><dd><?= htmlspecialchars($student["contact"] ?? "Not provided") ?></dd></div>
                <div><dt>Email</dt><dd><?= htmlspecialchars($student["email"] ?? "Not provided") ?></dd></div>
                <div><dt>Registered</dt><dd><?= htmlspecialchars($student["created_at"]) ?></dd></div>
            </dl>
            <p style="margin-top: 24px;"><a href="edit.php" class="button">Edit My Information <span aria-hidden="true">&rarr;</span></a></p>
        <?php endif; ?>
    </main>
</div>
</body>
</html>