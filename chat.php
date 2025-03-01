<?php
session_start();
include 'includes/auth.php'; // Ensure the user is logged in
include 'db.php';

// Get the receiver ID from the URL
$receiver_id = isset($_GET['receiver_id']) ? (int)$_GET['receiver_id'] : null;
$user_id = $_SESSION['user_id'];

// Debugging: Print sender and receiver IDs
echo "<p>Sender ID: $user_id</p>";
echo "<p>Receiver ID: $receiver_id</p>";

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);

    if (!empty($message) && $receiver_id) {
        // Insert the message into the database
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $receiver_id, $message);
        if ($stmt->execute()) {
            // Message sent successfully
            echo "<p class='success'>Message sent!</p>";
        } else {
            echo "<p class='error'>Failed to send message. Please try again.</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='error'>Invalid message or receiver ID.</p>";
    }
}

// Fetch chat history
if ($receiver_id) {
    $stmt = $conn->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY sent_at ASC");
    $stmt->bind_param("iiii", $user_id, $receiver_id, $receiver_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<p class='error'>No receiver specified.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="styless.css"> <!-- Link to your CSS file -->
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

/* Chat container styling */
.chat-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff; /* White background for the chat container */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Chat heading styling */
.chat-container h2 {
    color: #8174A0; /* Primary heading color */
    margin-bottom: 20px;
}

/* Chat box styling */
#chat-box {
    height: 400px;
    overflow-y: auto;
    border: 1px solid #A888B5; /* Border color */
    border-radius: 5px;
    padding: 10px;
    background-color: #f4f4f9; /* Light background for the chat box */
    margin-bottom: 20px;
}

/* Message styling */
.message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    max-width: 70%;
    word-wrap: break-word;
}

/* Sent message styling */
.message.sent {
    background-color: #EFB6C8; /* Sent message background color */
    color: #ffffff; /* Sent message text color */
    margin-left: auto;
}

/* Received message styling */
.message.received {
    background-color: #A888B5; /* Received message background color */
    color: #ffffff; /* Received message text color */
    margin-right: auto;
}

/* Timestamp styling */
.message small {
    display: block;
    font-size: 12px;
    color: #8174A0; /* Timestamp text color */
    margin-top: 5px;
}

/* Form styling */
form {
    display: flex;
    gap: 10px;
}

form textarea {
    flex: 1;
    padding: 10px;
    border: 1px solid #A888B5; /* Border color */
    border-radius: 5px;
    font-size: 16px;
    color: #8174A0; /* Text color */
    background-color: #f4f4f9; /* Light background for textarea */
}

form textarea::placeholder {
    color: #A888B5; /* Placeholder text color */
}

form button {
    background-color: #8174A0; /* Button background color */
    color: #ffffff; /* Button text color */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
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






    <div class="chat-container">
        <h2>Chat with User <?= $receiver_id ?></h2>
        <div id="chat-box">
            <?php if ($receiver_id && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="message <?= $row['sender_id'] === $user_id ? 'sent' : 'received' ?>">
                        <?= htmlspecialchars($row['message']) ?>
                        <small><?= date('h:i A', strtotime($row['sent_at'])) ?></small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No messages found.</p>
            <?php endif; ?>
        </div>
        <form method="POST" action="chat.php?receiver_id=<?= $receiver_id ?>">
            <textarea name="message" placeholder="Type your message..." required></textarea>
            <button type="submit">Send</button>
        </form>
        <button id="backButton">Go Back</button>
    </div>

    <script> document.getElementById("backButton").addEventListener("click", function() {
    history.back();
});</script>
</body>
</html>