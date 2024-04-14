<?php

if (!isset ($_SESSION['user'] )){
    header('Location:../Auth/login-1.php');
}