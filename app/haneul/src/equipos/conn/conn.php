<?php
$servername = "sql307.infinityfree.com";
$username = "if0_37343459";
$password = "swApAwcG9S";
$dbname = "if0_37343459_qr_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
