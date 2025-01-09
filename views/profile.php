<main>
    <div class="space"></div>

    <div style="display: flex; width: 100%; justify-content: space-around;">
        <div style="background-color: blue; width: 60%; height: 65vh;">
            <div style="display: flex; justify-content: space-between; margin: 0 5%; margin-bottom:2%">
                <div class="option" data-action="samples" style="width: 30%; height: 10vh; background-color: red; display: flex; align-items: center; justify-content: center; cursor: pointer;">Mes Samples</div>
                <div class="option" data-action="collabs" style="width: 30%; height: 10vh; background-color: red; display: flex; align-items: center; justify-content: center; cursor: pointer;">Mes Collabs</div>
                <div class="option" data-action="formations" style="width: 30%; height: 10vh; background-color: red; display: flex; align-items: center; justify-content: center; cursor: pointer;">Mes Formations</div>
            </div>
            <div class="squares-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; margin:0 5%; ">
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;"></div>
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;"></div>
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;"></div>
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;display:none;"></div>
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;display:none;"></div>
                <div class="square" style="height: 25vh; width: 30%; background-color: yellow; margin-bottom: 10px;display:none;"></div>
            </div>
        </div>

        <div style="border: 2px solid black;border-radius: 5%; width: 30%; height: 65vh;padding: 10px">
            <div style="display: flex; justify-content: space-between;">
            <div style="width: 25vh; height: 25vh; overflow: hidden; border-radius: 10%;">
    <img src="assets/img/picture1.png" alt="Profile PictureS" width="100%" height="100%" style="object-fit: cover;">
</div>

                <div style=" width: 35vh; height: 25vh; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <h2>MPSBeats</h2>
                        <div style="display: flex; justify-content: space-around">
                        <p>5*</p>
                        <p>|</p>
                        <p>Paris</p>
                        </div>
                </div>
            </div>
            <div style=" width: 100%; height: 25vh;">
                <br>
                <h2>Bio</h2>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quod.</p>
                <br>
                <div style="display: flex;">
                    <p>Trap,</p>
                    <p>RNB,</p>
                    <p>NEW WAVE</p>
                </div>
            </div>
            <div style="display: flex; justify-content: center; align-items: center; height: 15vh;">
                <button style="background-color: green; padding: 10px; border-radius: 50px; text-align: center; line-height: 5vh; border: none; color: white; width: 50%;">Rounded Button</button>
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
</script>