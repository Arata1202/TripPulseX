<?php
session_start();
session_destroy();

header('Location:../../Pages/Auth/login-1.php');
?>