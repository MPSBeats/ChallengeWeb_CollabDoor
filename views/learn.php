<?php
require_once '../models/learnsModel.php';

$learning = new Learn();
$learnings = $learning->getAllLearnings()

?>

<main>
    <div class="space"></div>
    <div>
        <h2>Les formations</h2>
    </div>
    <div class="squares-container-formation">
        <!-- Render all thumbnails by default (collabs and formations) -->
        <?php foreach ($learnings as $index => $learning): ?>

            <form id="myForm<?= $index ?>" style="display: block; width: 30%" action="index.php" method="get">
                <a class="form-link" href=" #" onclick="document.getElementById('myForm<?= $index ?>').submit(); return false;">
                    <div class="full-size-square ">
                        <img src="<?= htmlspecialchars($learning['thumbnail']); ?>" alt="Learning Thumbnail" class="square-img">
                    </div>
                    <input type="hidden" name="page" value="learningProfile">
                    <input type="hidden" name="learning" value="<?= htmlspecialchars($learning['title']); ?>">
                    <p><?= htmlspecialchars($learning['title']); ?></p>
                </a>
            </form>

        <?php endforeach; ?>
    </div>

</main>