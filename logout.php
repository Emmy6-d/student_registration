<?php

require_once "auth.php";

start_session();
$_SESSION = [];
session_destroy();

header("Location: index.php");
exit;

?>