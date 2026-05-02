<?php
$conn = new mysqli("localhost", "root", "", "author");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>