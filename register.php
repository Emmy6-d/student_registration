<?php

require_once "config.php";

$message = "";
$messageType = "";

$name = "";
$age = "";
$gender = "";
$class = "";
$contact = "";
$email = "";
$password = "";
$passwordConfirmation = "";
$registeredStudentId = "";
$classOptions = ["Senior 1", "Senior 2", "Senior 3", "Senior 4", "Senior 5", "Senior 6"];
$genderOptions = ["Male", "Female"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $class = trim($_POST["class"] ?? "");
    $contact = trim($_POST["contact"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $passwordConfirmation = $_POST["password_confirmation"] ?? "";

    if ($name === "" || $age === "" || $gender === "" || $class === "" || $contact === "" || $email === "" || $password === "" || $passwordConfirmation === "") {
        $message = "Please fill in all required fields.";
        $messageType = "error";
    } elseif (strlen($name) < 2 || strlen($name) > 100) {
        $message = "Name must be between 2 and 100 characters.";
        $messageType = "error";
    } elseif (!filter_var($age, FILTER_VALIDATE_INT)) {
        $message = "Age must be a valid number.";
        $messageType = "error";
    } elseif ((int)$age < 3 || (int)$age > 100) {
        $message = "Please enter a valid age between 3 and 100.";
        $messageType = "error";
    } elseif (!in_array($gender, $genderOptions, true)) {
        $message = "Please choose Male or Female.";
        $messageType = "error";
    } elseif (!in_array($class, $classOptions, true)) {
        $message = "Please choose a class from Senior 1 to Senior 6.";
        $messageType = "error";
    } elseif (strlen($contact) < 7 || strlen($contact) > 30) {
        $message = "Please enter a valid contact number.";
        $messageType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters long.";
        $messageType = "error";
    } elseif ($password !== $passwordConfirmation) {
        $message = "Passwords do not match.";
        $messageType = "error";
    } else {
        try {
            $existing = $pdo->prepare("SELECT id FROM students WHERE email = :email LIMIT 1");
            $existing->execute([":email" => $email]);

            if ($existing->fetch()) {
                $message = "An account with that email already exists. Please sign in instead.";
                $messageType = "error";
            } else {
                $yearPrefix = date("Y");
                $sequenceStmt = $pdo->prepare(
                    "SELECT MAX(CAST(SUBSTRING(student_id, 5, 4) AS UNSIGNED)) AS last_sequence
                     FROM students
                     WHERE student_id LIKE :year_prefix"
                );
                $sequenceStmt->execute([":year_prefix" => $yearPrefix . "%"]);
                $lastSequence = (int)($sequenceStmt->fetch()["last_sequence"] ?? 0);
                $nextSequence = $lastSequence + 1;

                if ($nextSequence > 9999) {
                    throw new RuntimeException("The yearly student ID sequence is full.");
                }

                $registeredStudentId = $yearPrefix . str_pad((string)$nextSequence, 4, "0", STR_PAD_LEFT);
                $sql = "INSERT INTO students (student_id, name, age, gender, class, contact, email, password_hash)
                        VALUES (:student_id, :name, :age, :gender, :class, :contact, :email, :password_hash)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ":student_id" => $registeredStudentId,
                    ":name" => $name,
                    ":age" => (int)$age,
                    ":gender" => $gender,
                    ":class" => $class,
                    ":contact" => $contact,
                    ":email" => $email,
                    ":password_hash" => password_hash($password, PASSWORD_DEFAULT)
                ]);

                $subject = "Bluebridge Student Registration Confirmation";
                $emailBody = "Hello " . $name . ",\n\n"
                    . "Your Bluebridge student registration was successful.\n\n"
                    . "Student ID: " . $registeredStudentId . "\n"
                    . "Use this student ID and the password you created to sign in.\n\n"
                    . "Please keep this message safe.\n\n"
                    . "Regards,\nBluebridge Student Hub";
                $headers = "From: " . $mailFrom . "\r\n"
                    . "Reply-To: " . $mailFrom . "\r\n"
                    . "Content-Type: text/plain; charset=UTF-8\r\n";

                if (mail($email, $subject, $emailBody, $headers)) {
                    $message = "Student registered successfully. A confirmation email with the student ID has been sent to the address provided.";
                    $messageType = "success";
                } else {
                    $message = "Student registered, but the confirmation email could not be sent. Please contact the school administrator.";
                    $messageType = "error";
                }
                $name = "";
                $age = "";
                $gender = "";
                $class = "";
                $contact = "";
                $email = "";
                $password = "";
                $passwordConfirmation = "";
            }
        } catch (Throwable $e) {
            $message = $e instanceof RuntimeException
                ? $e->getMessage()
                : "Unable to register the student.";
            $messageType = "error";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student | Bluebridge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div class="brand-wrap">
            <div class="brand-mark">B</div>
            <h1>Bluebridge Student Hub</h1>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php" class="active">Register Student</a>
            <a href="list.php">View Students</a>
            <a href="options.php">Options</a>
            <a href="login.php">Sign In</a>
        </nav>
    </header>
    <main class="card form-card">
        <div class="eyebrow">NEW STUDENT PROFILE</div>
        <h2>Register a Student</h2>
        <p class="intro">Add a learner to your campus directory in just a few details.</p>
        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" id="name" name="name" maxlength="100" required value="<?= htmlspecialchars($name) ?>" placeholder="Enter student name">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" min="3" max="100" required value="<?= htmlspecialchars($age) ?>" placeholder="Enter age">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Choose gender</option>
                    <?php foreach ($genderOptions as $genderOption): ?>
                        <option value="<?= htmlspecialchars($genderOption) ?>" <?= $gender === $genderOption ? "selected" : "" ?>>
                            <?= htmlspecialchars($genderOption) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="tel" id="contact" name="contact" maxlength="30" required value="<?= htmlspecialchars($contact) ?>" placeholder="Enter contact number">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" maxlength="150" required value="<?= htmlspecialchars($email) ?>" placeholder="Enter email address">
            </div>
            <div class="form-group">
                <label for="password">Create Password</label>
                <input type="password" id="password" name="password" minlength="8" required placeholder="At least 8 characters">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required placeholder="Re-enter password">
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <select id="class" name="class" required>
                    <option value="">Choose class</option>
                    <?php foreach ($classOptions as $classOption): ?>
                        <option value="<?= htmlspecialchars($classOption) ?>" <?= $class === $classOption ? "selected" : "" ?>>
                            <?= htmlspecialchars($classOption) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Register Student <span aria-hidden="true">&rarr;</span></button>
        </form>
    </main>
</div>
</body>
</html>
