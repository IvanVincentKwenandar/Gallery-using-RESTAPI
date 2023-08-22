<?php

session_start();
setcookie(session_name(), '', 100);
$_SESSION = [];
session_unset();
session_destroy();

header("Location: ../login.php");
exit;

?>