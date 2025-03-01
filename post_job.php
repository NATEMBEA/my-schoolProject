<?php
include 'includes/auth.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $client_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO jobs (client_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $client_id, $title, $description);
    $stmt->execute();
    $stmt->close();

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job</title>
    <link rel="stylesheet" href="stylesS.css"> <!-- Link to your CSS file -->
</head>
<body>

<style>/* General body styling */
body {
    background-color: #f4f4f9; /* Light background color */
    font-family: Arial, sans-serif;
    color: #8174A0; /* Primary text color */
    margin: 0;
    padding: 20px;
}

/* Form container styling */
form {
    background-color: #ffffff; /* White background for the form */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
}

/* Input fields styling */
input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #A888B5; /* Border color */
    border-radius: 5px;
    font-size: 16px;
    color: #8174A0; /* Text color */
    background-color: #f4f4f9; /* Light background for inputs */
}

input[type="text"]::placeholder,
textarea::placeholder {
    color: #A888B5; /* Placeholder text color */
}

/* Button styling */
button[type="submit"] {
    background-color: #EFB6C8; /* Button background color */
    color: #ffffff; /* Button text color */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #A888B5; /* Hover background color */
}

/* Link styling */
a {
    color: #8174A0; /* Link color */
    text-decoration: none;
}

a:hover {
    color: #A888B5; /* Hover link color */
}</style>



    <form method="POST" action="post_job.php">
        <input type="text" name="title" placeholder="Job Title" required>
        <textarea name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button><br><br>
       <div> <button id="backButton">Go Back</button></div>
    </form>

    <script>document.getElementById("backButton").addEventListener("click", function() {
    history.back();
});</script>
</body>
</html>