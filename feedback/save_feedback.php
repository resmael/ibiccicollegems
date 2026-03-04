<?php
include '../assets/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // English + Filipino bad words list
    $badwords = [
        "fuck", "shit", "asshole", "bitch", "bobo", "gago", "tanga", "ulol",
        "pakyu", "pota", "putangina", "pucha", "bwisit", "leche", "hayop",
        "inutil", "tarantado", "unggoy"
    ];

    $lowerMessage = strtolower($message);
    foreach ($badwords as $badword) {
        if (strpos($lowerMessage, $badword) !== false) {
            echo "❌ Feedback not accepted. Inappropriate words detected.";
            exit;
        }
    }

    $query = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $query)) {
        echo "✅ Feedback submitted successfully!";
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
}
?>
