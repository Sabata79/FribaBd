<?php
session_start();
require('./userFunctions.php');
session_destroy();
unset($_SESSION["username"]);

http_response_code(200);
echo "Logged out";