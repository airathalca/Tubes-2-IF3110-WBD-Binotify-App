<?php

require_once __DIR__ . '/../app/init.php';

if (session_status() === PHP_SESSION_ACTIVE) {
    $current_time = time();

    if ($current_time - $_SESSION['updated_at'] > SESSION_REGENERATION_TIME) {
        // Prevent Session Fixation Attacks
        session_regenerate_id(true);
        $_SESSION['updated_at'] = $current_time;
    }

    if ($current_time - $_SESSION['created_at'] > SESSION_EXPIRATION_TIME) {
        session_unset();
        session_destroy();
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();

    $current_time = time();
    $_SESSION['created_at'] = $current_time;
    $_SESSION['updated_at'] = $current_time;
}

$app = new App();
