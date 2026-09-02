<?php

session_start();
require_once "config.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$message = "";
$messageType = "";
$classOptions = ["Senior 1", "Senior 2", "Senior 3", "Senior 4", "Senior 5", "Senior 6"];
$genderOptions = ["Male", "Female"];
$isVerified = $_SESSION["edit_authorized_{$id}"] ?? false;

if (!$id) {
    header("Location: list.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, name, age, gender, class, contact, email, password_hash FROM students WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $student = $stmt->fetch();

    if (!$student) {
        header("Location: list.php");
        exit;
    }
} catch (PDOException $e) {
    $student = null;
    $message = "Unable to retrieve the student record.";
    $messageType = "error";
}

$gender = $student["gender"] ?? "";
$name = $student["name"] ?? "";
$age = $student["age"] ?? "";
$class = $student["class"] ?? "";
$contact = $student["contact"] ?? "";
$email = $student["email"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $student) {
    if (($_POST["action"] ?? "") === "verify") {
        $verificationName = trim($_POST["verification_name"] ?? "");
        $verificationContact = trim($_POST["verification_contact"] ?? "");
        $verificationPassword = $_POST["verification_password"] ?? "";

        if (
            hash_equals((string)$student["name"], $verificationName)
            && hash_equals((string)($student["contact"] ?? ""), $verificationContact)
            && !empty($student["password_hash"])
            && password_verify($verificationPassword, $student["password_hash"])
        ) {
            $_SESSION["edit_authorized_{$id}"] = true;
            $isVerified = true;
        } else {
            $message = "The name, contact, or password does not match our records.";
            $messageType = "error";
        }
    } elseif (($_POST["action"] ?? "") === "update" && $isVerified) {
        $name = trim($_POST["name"] ?? "");
        $age = trim($_POST["age"] ?? "");
        $gender = trim($_POST["gender"] ?? "");
        $class = trim($_POST["class"] ?? "");
        $contact = trim($_POST["contact"] ?? "");
        $email = trim($_POST["email"] ?? "");

        if ($name === "" || $age === "" || $gender === "" || $class === "" || $contact === "" || $email === "") {
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
        } else {
            try {
                $update = $pdo->prepare("UPDATE students SET name = :name, age = :age, gender = :gender, class = :class, contact = :contact, email = :email WHERE id = :id");
                $update->execute([
                    ":name" => $name,
                    ":age" => (int)$age,
                    ":gender" => $gender,
                    ":class" => $class,
                    ":contact" => $contact,
                    ":email" => $email,
                    ":id" => $id
                ]);
                unset($_SESSION["edit_authorized_{$id}"]);
                header("Location: list.php?updated=1");
                exit;
            } catch (PDOException $e) {
                $message = "Unable to update the student record.";
                $messageType = "error";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Bluebridge</title>
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
            <a href="register.php">Register Student</a>
            <a href="list.php" class="active">View Students</a>
            <a href="options.php">Options</a>
        </nav>
    </header>

    <main class="card form-card">
        <div class="eyebrow">UPDATE STUDENT PROFILE</div>
        <h2>Complete Student Data</h2>
        <p class="intro">Update all information for <?= htmlspecialchars($student["name"] ?? "this student") ?>.</p>

        <?php if ($message !== ""): ?>
            <div class="message <?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if ($student && !$isVerified): ?>
            <div class="verification-panel">
                <h3>Verify your identity</h3>
                <p>Enter the name, contact, and password used during registration before editing this record.</p>
                <form method="POST" action="edit.php?id=<?= $id ?>">
                    <input type="hidden" name="action" value="verify">
                    <div class="form-group">
                        <label for="verification_name">Registered Name</label>
                        <input type="text" id="verification_name" name="verification_name" required autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="verification_contact">Registered Contact</label>
                        <input type="tel" id="verification_contact" name="verification_contact" required autocomplete="tel">
                    </div>
                    <div class="form-group">
                        <label for="verification_password">Registration Password</label>
                        <input type="password" id="verification_password" name="verification_password" required autocomplete="current-password">
                    </div>
                    <button type="submit">Verify and Continue <span aria-hidden="true">&rarr;</span></button>
                </form>
            </div>
        <?php elseif ($student): ?>
            <form method="POST" action="edit.php?id=<?= $id ?>">
                <input type="hidden" name="action" value="update">
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

                <div class="filter-buttons">
                    <button type="submit">Save Changes <span aria-hidden="true">&rarr;</span></button>
                    <a href="list.php" class="button secondary">Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
