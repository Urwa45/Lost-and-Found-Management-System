<?php
session_start();
session_unset();   // remove all session variables
session_destroy(); 

header("Location: index.php");
exit();
