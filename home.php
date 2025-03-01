<?php
session_start();
include 'db.php';


// Redirect logged-in users to the appropriate page
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin.php'); // Redirect admins to the admin panel
    } else {
        header('Location: dashboard.php'); // Redirect non-admins to the dashboard
    }
    exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Store user details in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($_SESSION['role'] === 'admin') {
                header('Location: admin.php'); // Redirect admins to the admin panel
            } else {
                header('Location: dashboard.php'); // Redirect non-admins to the dashboard
            }
            exit();
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }
    $stmt->close();
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Save user details in session for later use
    $_SESSION['registration_data'] = [
        'username' => $username,
        'password' => $password,
        'role' => $role,
    ];

    // Redirect to Paystack payment page
    header('Location: paystack_payment.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Platform - Home</title>
    <link rel="stylesheet" href="styless.css"> <!-- Link to your CSS file -->
</head>
<body>

<div class="navbar__container">
    <a href="#home" id="navbar__logo">LP4-DEV</a>
    <ul class="navebar__menu">
      <li class="navbar__item">
        <li class="navbar__item">
          <a href="index.php" class="navbar__links" id="home-page">Home</a>
          </li>
          <li class="navbar__item">
            <a href="faq.php" class="navbar__links" id="faq-page">FAQ</a>
          </li>
          <li class="navbar__item">
            <a href="home.php" class="navbar__links" id="postjob-page">Login</a>
          </li>
          <li class="navbar__item">
            <a href="admin.php" class="navbar__links" id="postjob-page">Admin</a>
          </li>
          <li class="navbar__btn">
            <a href="home.php" class="button" id="home-page">Register</a>
      </li>
    </ul>
  </div>
</nav>


<style>/* General body styling */
body {
    background-color: #f4f4f9; /* Light background color */
    font-family: Arial, sans-serif;
    color: #8174A0; /* Primary text color */
    margin: 0;
    padding: 20px;
}


/* Navbar Styles */
.navbar {
    background-color: #8174A0; /* Primary color */
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

#navbar__logo {
    color: #FFD2A0; /* Accent color */
    font-size: 1.5rem;
    text-decoration: none;
    font-weight: bold;
}

.navebar__menu {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
}

.navbar__links {
    color: #EFB6C8; /* Secondary color */
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.navbar__links:hover {
    color: #FFD2A0; /* Accent color */
}

.button {
    background-color: #A888B5; /* Tertiary color */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #8174A0; /* Primary color */
}

/* Container styling */
.container {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

/* Heading styling */
h1 {
    color: #8174A0; /* Primary heading color */
    margin-bottom: 20px;
}

/* Form container styling */
.form-container {
    background-color: #ffffff; /* White background for forms */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    text-align: left;
}

.form-container h2 {
    color: #8174A0; /* Form heading color */
    margin-bottom: 15px;
}

/* Input fields styling */
input[type="text"],
input[type="password"],
select {
    width: 80%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #A888B5; /* Border color */
    border-radius: 5px;
    font-size: 16px;
    color: #8174A0; /* Text color */
    background-color: #f4f4f9; /* Light background for inputs */
}

input[type="text"]::placeholder,
input[type="password"]::placeholder {
    color: #A888B5; /* Placeholder text color */
}

/* Button styling */
button[type="submit"] {
    background-color: #8174A0; /* Button background color */
    color: #ffffff; /* Button text color */
    border: none;
    padding: 10px 5px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #A888B5; /* Hover background color */
}

/* Success and error message styling */
.success {
    color: #28a745; /* Success message color */
    margin-bottom: 10px;
}

.error {
    color: #dc3545; /* Error message color */
    margin-bottom: 10px;
}</style>





    <div class="container">
        <h1>Welcome to LP4-DEV Job Platform</h1>

        <!-- Login Form -->
        <div class="form-container">
            <h2>Login</h2>
            <?php if (isset($login_error)): ?>
                <p class="error"><?= $login_error ?></p>
            <?php endif; ?>
            <form method="POST" action="home.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-container">
            <h2>Register</h2>
            <?php if (isset($registration_success)): ?>
                <p class="success"><?= $registration_success ?></p>
            <?php endif; ?>
            <?php if (isset($registration_error)): ?>
                <p class="error"><?= $registration_error ?></p>
            <?php endif; ?>
            <form method="POST" action="home.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="client">Client</option>
                    <option value="developer">Developer</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register and Pay</button>
            </form>
        </div>
    </div>
</body>
</html>