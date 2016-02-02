<?php

session_start();
$_SESSION['user_name']="takahiro";
echo $_SESSION['user_name'];

unset($_SESSION['user_name']);
echo $_SESSION['user_name'];
