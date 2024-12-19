<?php
// Start or resume the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Optionally clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

echo "Session ended.";
header('Location:blogtem.php');
?>