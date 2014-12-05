<?php
session_start();
$_SESSION['request_token'] = null;
$_SESSION['access_token'] = null;
session_destroy();

header('Location: index.php');
?>
