<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie("!87yghgggkkh", '', time() - 60 * 60);
setcookie("!kljasjljnhekls", '', time() - 60 * 60);

header("Location: login.php");
exit();

?>