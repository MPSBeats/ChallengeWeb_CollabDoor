<main>
    <div class="space"></div>

    <?php
    session_start();

    if (!isset($_SESSION['pseudo'])) {
        header("Location: index.php?page=login");
        exit();
    }


    $pseudo = $_SESSION['pseudo'];
    $selectedUser = '';



    if (isset($_GET['user'])) {
        $selectedUser = $_GET['user'];
        $selectedUser    = mysqli_real_escape_string($db, $selectedUser);
        $showChatBox = true; // Set to true only when a user is selected
    } else {
        $showChatBox = false; // Set to false initially
    }


    ?>


        <div class="account-info">
            <div class="welcome">
                <h2>Bienvenue, <?php echo ucfirst($pseudo); ?>!</h2>
            </div>
            <div class="user-list">
                <h2>Choisi un artiste avec qui discuter:</h2>
                <ul>
                    <?php 
                    // Fetch all users except the current user
                    $sql = "SELECT DISTINCT u1.pseudo FROM Users u1 
                            JOIN UsersChats uc ON u1.id_user = uc.id_userchat 
                            JOIN Chats c ON uc.id_userchat = c.sender OR uc.id_userchat = c.receiver 
                            JOIN Users u2 ON (c.sender = u2.id_user OR c.receiver = u2.id_user) 
                            WHERE u1.id_user <> u2.id_user;";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $user = $row['pseudo'];
                            $user = ucfirst($user);
                            echo "<li><a href='message.php?user=$user'>$user</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php if ($showChatBox): ?>
        <div class="chat-box" id="chat-box">
            <div class="chat-box-header">
                <h2><?php echo ucfirst($selectedUser); ?></h2>
                <button class="close-btn" onclick="closeChat()">✖</button>
            </div>
            <div class="chat-box-body" id="chat-box-body">
                <!-- Chat messages will be loaded here -->
            </div>
            <form class="chat-form" id="chat-form">
                <input type="hidden" id="sender" value="<?php echo $pseudo; ?>">
                <input type="hidden" id="receiver" value="<?php echo $selectedUser; ?>">
                <input type="text" id="message" placeholder="Type your message..." required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <?php endif; ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        function closeChat() {
            document.getElementById("chat-box").style.display = "none";
        }


        // Function to toggle chat box visibility
        function toggleChatBox() {
        var chatBox = document.getElementById("chat-box");
        if (chatBox.style.display === "none") {
            chatBox.style.display = "block"; // Show the chat box
        } else {
            chatBox.style.display = "none"; // Hide the chat box
        }
    }


    function fetchMessages() {
                var sender = $('#sender').val();
                var receiver = $('#receiver').val();
                
                $.ajax({
                    url: 'fetch_messages.php',
                    type: 'POST',
                    data: {sender: sender, receiver: receiver},
                    success: function(data) {
                        $('#chat-box-body').html(data);
                        scrollChatToBottom();
                    }
                });
            }


            // Function to scroll the chat box to the bottom
            function scrollChatToBottom() {
                var chatBox = $('#chat-box-body');
                chatBox.scrollTop(chatBox.prop("scrollHeight"));
            }

    
            
            $(document).ready(function() {
                // Fetch messages every 3 seconds
                
                fetchMessages();
                setInterval(fetchMessages, 3000);
            });


                // Submit the chat message
                $('#chat-form').submit(function(e) {
                e.preventDefault();
                var sender = $('#sender').val();
                var receiver = $('#receiver').val();
                var message = $('#message').val();

                $.ajax({
                    url: 'submit_message.php',
                    type: 'POST',
                    data: {sender: sender, receiver: receiver, message: message},
                    success: function() {
                        $('#message').val('');
                        fetchMessages(); // Fetch messages after submitting
                    }
                });

                });


    </script>

</main>