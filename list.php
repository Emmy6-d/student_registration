<?php

require_once "config.php";

$search = trim($_GET["search"] ?? "");
$classFilter = trim($_GET["class"] ?? "");

try {

    $sql = "SELECT id, name, age, class, created_at
            FROM students
            WHERE 1=1";

    $params = [];

    if ($search !== "") {

        $sql .= " AND name LIKE :search";

        $params[":search"] = "%" . $search . "%";
    }

    if ($classFilter !== "") {

        $sql .= " AND class = :class";

        $params[":class"] = $classFilter;
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);

    $stmt->execute($params);

    $students = $stmt->fetchAll();


    $classStmt = $pdo->query(
        "SELECT DISTINCT class
         FROM students
         ORDER BY class ASC"
    );

    $classes = $classStmt->fetchAll();

    $error = "";

} catch (PDOException $e) {

    $students = [];
    $classes = [];

    $error = "Unable to retrieve student records.";
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student List</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <header class="header">

        <h1>Student Registration System</h1>

        <nav>

            <a href="index.php">
                Register Student
            </a>

            <a href="list.php" class="active">
                View Students
            </a>

        </nav>

    </header>


    <main class="card">

        <h2>Registered Students</h2>


        <?php if ($error !== ""): ?>

            <div class="message error">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <form method="GET"
              action="list.php"
              class="filter-form">

            <div class="form-group">

                <label for="search">
                    Search by Name
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="<?= htmlspecialchars($search) ?>"
                    placeholder="Enter student name"
                >

            </div>


            <div class="form-group">

                <label for="class">
                    Filter by Class
                </label>

                <select id="class" name="class">

                    <option value="">
                        All Classes
                    </option>

                    <?php foreach ($classes as $class): ?>

                        <option
                            value="<?= htmlspecialchars($class["class"]) ?>"
                            <?= $classFilter === $class["class"]
                                ? "selected"
                                : "" ?>
                        >
                            <?= htmlspecialchars($class["class"]) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="filter-buttons">

                <button type="submit">
                    Search
                </button>

                <a href="list.php"
                   class="button secondary">
                    Clear
                </a>

            </div>

        </form>


        <?php if (count($students) > 0): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Age</th>

                        <th>Class</th>

                        <th>Registered</th>

                    </tr>

                    </thead>


                    <tbody>

                    <?php foreach ($students as $student): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($student["id"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student["name"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student["age"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student["class"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student["created_at"]) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty">
                No students found.
            </div>

        <?php endif; ?>

    </main>

</div>

</body>

</html>