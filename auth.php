<?php

function start_session(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function require_login(): void
{
    start_session();

    if (empty($_SESSION["student_id"])) {
        header("Location: login.php");
        exit;
    }
}

function current_student_id(): ?int
{
    start_session();

    return isset($_SESSION["student_id"]) ? (int)$_SESSION["student_id"] : null;
}

?>