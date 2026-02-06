<?php

$db = new mysqli(
    "localhost",
    "root",
    "",
    "velour_ctrl_db"
);

if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}
