<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MKU Query Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: red;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            flex-direction: column; /* Change layout to column to have tabs at the top */
        }

        /* Sidebar styles - now positioned at the top */
        .sidebar {
            width: 100%; /* Full width for top navigation */
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center; /* Center align the navigation */
        }

        .sidebar a {
            display: inline-block; /* Display links horizontally */
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            color: #007bff;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #f0f0f0;
        }

        /* Slideshow container */
        .slideshow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        /* Each slide */
        .mySlides {
            display: none;
            height: 100%;
            width: 100%;
            position: absolute;
            background-size: cover;
            background-position: center;
        }

        .chat-container {
            width: 80%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .chatbot-intro {
            color: #555;
            text-align: center;
            margin-bottom: 15px;
        }

        .chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #4998e3;
        }

        .user-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .send-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        .send-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<!-- Sidebar with navigation links (now at the top) -->
<div class="sidebar">
    <a href="user_history.php">User History</a>
    <a href="unanswered.php">Unanswered Queries</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Slideshow container -->
<div class="slideshow-container">
    <div class="mySlides" style="background-image: url('mku_place.jpeg');"></div>
</div>

<div class="chat-container">
    <h3 class="welcome-message">Welcome, <?php echo $_SESSION['username']; ?>!</h3>
    <p class="chatbot-intro">My name is chatbot. Ask me anything about the IT Department in MKU:</p>

    <div class="chat-box" id="chatBox"></div>

    <div class="input-container">
        <input type="text" id="userInput" class="user-input" placeholder="Type your question..." />
        <button class="send-button" onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
    // JavaScript for the slideshow
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }

    // JavaScript for the chatbot
    let chatBox = document.getElementById("chatBox");
    let userInput = document.getElementById("userInput");

    function sendMessage() {
        let userMessage = userInput.value.trim();
        if (userMessage === "") return;

        // Display user message in chat box
        let chatMessage = document.createElement("div");
        chatMessage.className = "chat-message";
        chatMessage.innerHTML = `<p><strong>You:</strong> ${userMessage}</p>`;
        chatBox.appendChild(chatMessage);

        // Clear the input
        userInput.value = "";

        // Send the message to the server
        fetch("mku_chatbot_response.php", { 
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({ message: userMessage })
        })
        .then(response => response.json())
        .then(data => {
            // Display the chatbot response
            let responseMessage = document.createElement("div");
            responseMessage.className = "chat-message";
            responseMessage.innerHTML = `<p><strong>Chatbot:</strong> ${data.response}</p>`;
            chatBox.appendChild(responseMessage);

            // Scroll to the bottom of the chat box
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => {
            console.error("Error:", error); // Log any errors
        });
    }
</script>

</body>
</html>
