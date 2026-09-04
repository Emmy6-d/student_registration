<?php

require_once "config.php";
require_once "auth.php";

start_session();

if (!empty($_SESSION["student_id"])) {
    header("Location: account.php");
    exit;
}

$message = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === "") {
        $message = "Enter the email and password used during registration.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, password_hash FROM students WHERE email = :email LIMIT 1");
            $stmt->execute([":email" => $email]);
            $student = $stmt->fetch();

            if ($student && !empty($student["password_hash"]) && password_verify($password, $student["password_hash"])) {
                session_regenerate_id(true);
                $_SESSION["student_id"] = (int)$student["id"];
                header("Location: account.php");
                exit;
            }

            $message = "The email or password is incorrect.";
        } catch (PDOException $e) {
            $message = "Unable to sign in right now.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Bluebridge</title>
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
            <a href="login.php" class="active">Sign In</a>
        </nav>
    </header>

    <main class="card form-card narrow-card">
        <div class="eyebrow">STUDENT ACCOUNT</div>
        <h2>Sign in to your account</h2>
        <p class="intro">Use the email and password you created during registration to view your complete information.</p>
        <?php if ($message !== ""): ?>
            <div class="message error"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email) ?>" autocomplete="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit">Sign In <span aria-hidden="true">&rarr;</span></button>
        </form>
    </main>
</div>
</body>
</html>