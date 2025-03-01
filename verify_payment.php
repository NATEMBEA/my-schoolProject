<?php
session_start();
include 'db.php';

if (!isset($_SESSION['registration_data']) || !isset($_GET['reference'])) {
    header('Location: home.php');
    exit();
}

$reference = $_GET['reference'];
$secret_key = 'sk_test_328ad85828a0f81354dc346340ff976ae07adb2c'; // Replace with your Paystack secret key

// Verify payment with Paystack API
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $secret_key",
        "Cache-Control: no-cache",
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    die("Error verifying payment: $err");
}

$result = json_decode($response, true);

if ($result['data']['status'] === 'success') {
    // Payment successful, complete registration
    $username = $_SESSION['registration_data']['username'];
    $password = $_SESSION['registration_data']['password'];
    $role = $_SESSION['registration_data']['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        // Set session variables for the newly registered user
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Clear registration data from session
        unset($_SESSION['registration_data']);

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<p class='error'>Failed to complete registration. Please contact support.</p>";
    }

    $stmt->close();
} else {
    echo "<p class='error'>Payment verification failed. Please try again.</p>";
}
?>