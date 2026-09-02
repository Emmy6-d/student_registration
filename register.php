<?php

require_once "config.php";

$message = "";
$messageType = "";

$name = "";
$age = "";
$class = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $class = trim($_POST["class"] ?? "");

    if ($name === "" || $age === "" || $class === "") {
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
    } elseif (strlen($class) < 1 || strlen($class) > 50) {
        $message = "Please enter a valid class.";
        $messageType = "error";
    } else {
        try {
            $sql = "INSERT INTO students (name, age, class)
                    VALUES (:name, :age, :class)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":name" => $name,
                ":age" => (int)$age,
                ":class" => $class
            ]);
            $message = "Student registered successfully.";
            $messageType = "success";
            $name = "";
            $age = "";
            $class = "";
        } catch (PDOException $e) {
            $message = "Unable to register the student.";
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
        <h1>Bluebridge Student Hub</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php" class="active">Register Student</a>
            <a href="list.php">View Students</a>
            <a href="options.php">Options</a>
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
                <label for="class">Class</label>
                <input type="text" id="class" name="class" maxlength="50" required value="<?= htmlspecialchars($class) ?>" placeholder="Example: Senior 4">
            </div>
            <button type="submit">Register Student <span aria-hidden="true">&rarr;</span></button>
        </form>
    </main>
</div>
</body>
</html>
