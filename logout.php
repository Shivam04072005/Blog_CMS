<?php
session_start();
session_unset();
session_destroy();
include("header.php");
echo "Share your experience";
exit;
?>