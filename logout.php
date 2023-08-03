<?php 
session_start();

session_unset();
session_destroy();

echo '<script type="text/javascript">'; 
echo 'alert("로그아웃");';
echo 'window.location.href = "index.php";';
echo '</script>';
?>