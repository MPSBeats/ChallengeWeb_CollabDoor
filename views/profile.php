<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header('Location: index.php?page=home');
    exit();
}
?>

<main>
    <div class="space"></div>

    <div class="flex w-full justify-around">
        <div class="bg-blue-500 w-3/5 h-65vh">
            <div class="flex justify-between mx-5 mb-2">
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="samples">Mes Samples</div>
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="collabs">Mes Collabs</div>
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="formations">Mes Formations</div>
            </div>
            <div class="squares-container flex flex-wrap justify-between mx-5">
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2"></div>
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2"></div>
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2"></div>
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2 hidden"></div>
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2 hidden"></div>
                <div class="square h-25vh w-1/3 bg-yellow-500 mb-2 hidden"></div>
            </div>
        </div>

        <div class="border-2 border-black rounded-lg w-1/3 h-65vh p-2.5">
            <div class="flex justify-between">
                <div class="w-25vh h-25vh overflow-hidden rounded-full">
                    <img src="assets/img/picture1.png" alt="Profile PictureS" class="w-full h-full object-cover">
                </div>

                <div class="w-35vh h-25vh flex items-center justify-center flex-col">
                    <h2>MPSBeats</h2>
                    <div class="flex justify-around">
                        <p>5*</p>
                        <p>|</p>
                        <p>Paris</p>
                    </div>
                </div>
            </div>
            <div class="w-full h-25vh">
                <br>
                <h2>Bio</h2>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quod.</p>
                <br>
                <div class="flex">
                    <p>Trap,</p>
                    <p>RNB,</p>
                    <p>NEW WAVE</p>
                </div>
            </div>
            <div class="flex justify-center items-center h-15vh">
                <button class="bg-green-500 p-2.5 rounded-full text-center leading-5vh border-none text-white w-1/2">Rounded Button</button>

                <form action="index.php?page=profile" class="h-15vh w-1/2 flex items-center" method="post">
                    <button type="submit" class="bg-red-500 p-2.5 rounded-full text-center leading-5vh border-none text-white w-full">Logout</button>
                </form>
            </div>
        </div>

    </div>
</main>

<script>
    // Add event listeners to the top options
    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const squares = document.querySelectorAll('.square');
            const squaresContainer = document.querySelector('.squares-container');

            if (action === 'samples') {
                // Display only 3 squares and make them bigger
                squares.forEach((square, index) => {
                    if (index < 3) {
                        square.style.display = 'block'; // Show the first 3 squares
                        square.style.width = '30%'; // Increase width
                        square.style.height = '25vh'; // Increase height
                        square.style.backgroundColor = 'yellow'; // Change color
                    } else {
                        square.style.display = 'none'; // Hide the rest
                    }
                });
            } else {
                // Reset all squares for other actions
                squares.forEach(square => {
                    square.style.display = 'block'; // Show all squares
                    square.style.width = '30%'; // Reset to original width
                    square.style.height = '25vh'; // Reset to original height
                });

                // Optionally, change their color for other actions
                if (action === 'collabs') {
                    squares.forEach(square => square.style.backgroundColor = 'orange');
                } else if (action === 'formations') {
                    squares.forEach(square => square.style.backgroundColor = 'purple');
                }
            }
        });
    });

    // Simulate a click on the "samples" option when the page loads
    document.querySelector('.option[data-action="samples"]').click();
</script>