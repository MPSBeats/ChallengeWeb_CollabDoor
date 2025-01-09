<?php

    require_once '../models/database.php';
    $db = (new Database())->connect();

    $selectedUser = '';

    $user = strtolower($_SESSION['pseudo']);

    
if (isset($_GET['user'])) {
    $selectedUser = strtolower($_GET['user']);
    $showChatBox = true; // Set to true only when a user is selected
} else {
    $showChatBox = false; // Set to false initially

}
?>

<main id="discover">
    <div class="space"></div>

    <aside>
        <h2>Collaborer</h2>
        <p>Trouve ton futur duo ou ta future équipe pour briller dans le game !</p>
    </aside>

    <form action="">
        <label for="">
            <input type="text" name="recherche" placeholder="Rechercher un artiste, une collab...">
            <button type="submit" name="recherche"><img src="assets/img/search.svg" alt="loupe"></button>
        </label>
        <span>Filtrer par <img src="assets/img/chevron-up.svg" alt="up"></span>
        <div id="filter">
            <div>
                <input type="radio" name="type" id="collab" value="1">
                <label for="collab">Collaboration</label>
            </div>
            <div>
                <input type="radio" name="type" id="artiste" value="2">
                <label for="artiste">Artiste</label>
            </div>
            <hr>
            <div>
                <input type="radio" name="choix" id="recent" value="3">
                <label for="recent">Plus récent</label>
            </div>
            <div>
                <input type="radio" name="choix" id="populaire" value="4">
                <label for="populaire">Plus Populaire</label>
            </div>
            <label for="recherchetag" id="tag">
                <input type="text" name="recherchetag" placeholder="Rechercher un #tag...">
                <button name="recherchetag"><img src="assets/img/search.svg" alt="loupe"></button></label>
        </div>
    </form>

    <section>
        <h3>Collaborer avec :</h3>
        <button id="bLeftFiche"><img src="assets/img/circle-chevron-left.svg" alt="fleche gauche"></button>
        <section id="carrousselCollab">
            <?php
            $sql = "SELECT * FROM searchcollaborations";
            $result = $db->prepare($sql);
            $result->execute();
            $collaborations = $result->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($collaborations)): ?>
                <?php foreach ($collaborations as $collab): ?>
                    <article class="oeuvre">
                        <img src="assets/img/picture1.png" alt="">
                        <div>
                            <div>
                                <h4><?= htmlspecialchars($collab['title']) ?></h4>
                            </div>
                            <?php
                            $sqlPseudo = "SELECT u.pseudo
                                          FROM Users u
                                          JOIN userssearchcollaborations uc ON u.id_user = uc.id_user
                                          JOIN SearchCollaborations c ON uc.id_searchcollaborations = c.id_searchcollaborations
                                          WHERE c.id_searchcollaborations = ?";
                            $resultPseudo = $db->prepare($sqlPseudo);
                            $resultPseudo->execute([$collab['id_searchcollaborations']]);
                            $Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <div class="profile-picture-search">
                                <img src="<? $profilePicture ?>" alt="Profile Picture" class="profile-img-search-collab" onclick="window.location.href='index.php?page=profilView&id=1'">
                            </div>
                            <a href='index.php?page=collaborate&user=<?php 
                                if (!empty($Pseudos)): 
                                    foreach ($Pseudos as $pseudo): 
                                        echo htmlspecialchars($pseudo['pseudo']);
                                    endforeach; 
                                endif; ?>'>
                                <?php 
                                if (!empty($Pseudos)): ?>
                                    <p><?php foreach ($Pseudos as $pseudo): echo htmlspecialchars($pseudo['pseudo']);
                                        endforeach; ?></p> 
                                <?php else: ?>
                                    <p>Aucun pseudo trouvé.</p>
                                <?php endif; ?>
                                <img src="assets/img/mail-plus.svg">
                            </a>
                        
                        
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune collaboration trouvée.</p>
            <?php endif; ?>
        </section>
        <button id="bRightFiche"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>
    </section>



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
                    <input type="hidden" id="sender" value="<?php echo htmlspecialchars($user); ?>">

                    <input type="hidden" id="receiver" value="<?php echo $selectedUser; ?>">
                    <input type="text" id="message" placeholder="Tapez votre message..." required>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        <?php endif; ?>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function closeChat() {
        document.getElementById("chat-box").style.display = "none";
    }

    function fetchMessages() {
        var sender = $('#sender').val();
        var receiver = $('#receiver').val();

        console.log("Sender: " + sender);
        console.log("Receiver: " + receiver);

        // Sauvegarder la position actuelle du défilement
        var chatBox = $('#chat-box-body');
        var scrollTop = chatBox.scrollTop();
        var scrollHeight = chatBox.prop("scrollHeight");

        $.ajax({
        url: 'index.php?page=fetch_messages',
        type: 'POST',
        data: {
            sender: sender,
            receiver: receiver
        },
        success: function(data) {
            $('#chat-box-body').html(data);

            // Réinitialiser la position du défilement uniquement si l'utilisateur était en bas de la boîte de chat
            if (scrollTop + chatBox.outerHeight() >= scrollHeight) {
            scrollChatToBottom();
            } else {
            chatBox.scrollTop(scrollTop);
            }
        }
        });
    }

    function scrollChatToBottom() {
        var chatBox = $('#chat-box-body');
        chatBox.scrollTop(chatBox.prop("scrollHeight"));
    }

    $(document).ready(function() {
        // Fetch messages for the selected user when the page loads
        fetchMessages();

        // Fetch messages every 3 seconds
        setInterval(fetchMessages, 3000);

        // Submit the chat message
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            var message = $('#message').val();

            $.ajax({
                url: 'index.php?page=submit_message',
                type: 'POST',
                data: {
                    sender: sender,
                    receiver: receiver,
                    message: message
                },
                success: function() {
                    $('#message').val('');
                    fetchMessages(); // Fetch messages after submitting
                }
            });
        });
    });
</script>
