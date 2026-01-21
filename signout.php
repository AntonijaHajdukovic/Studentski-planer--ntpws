<?php
if (!defined('__APP__')) {
    define('__APP__', TRUE);
}
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
