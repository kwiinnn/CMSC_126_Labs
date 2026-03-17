<?php
function connectDB()
{
  $conn = mysqli_connect("localhost", "root", "", "smartphones_db");
  if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  return $conn;
}
?>