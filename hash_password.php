<?php
// Plaintext password to hash
$password = 'admin123'; // Replace with your desired password

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo "Plaintext Password: " . $password . "<br>";
echo "Hashed Password: " . $hashed_password;
?>