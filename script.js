// Add interactivity like dynamic notifications or chat updates
document.addEventListener('DOMContentLoaded', () => {
    // Example: Fetch notifications dynamically
    fetch('notifications.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('notifications').innerHTML = data;
        });
});

document.getElementById("backButton").addEventListener("click", function() {
    history.back();
});