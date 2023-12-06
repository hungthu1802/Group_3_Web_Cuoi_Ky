<?php
session_start();

// Hủy bỏ phiên đăng nhập
session_destroy();

header("Location: ../../login.php");
 ?>