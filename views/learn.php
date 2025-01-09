<?php
require_once '../models/learnsModel.php';

$learning = new Learn();
$learnings = $learning->getAllLearnings()

?>

<main style="min-height:90vh;">
    <!-- <style>
        .work-in-progress {
            font-size: 2em;
            text-align: center;
            margin-top: 20px;
        }
    </style> -->
    <!-- <div class="work-in-progress">
        🚧 Work in progres🚧s 
    </div> -->
    <div class="space"></div>
    <div>
        <h2>Les formations</h2>
    </div>
    <div class="squares-container-formation">
        <!-- Render all thumbnails by default (collabs and formations) -->
        <?php foreach ($learnings as $index => $learning): ?>
            <div style="display: block; width: 30%">
                <div class="full-size-square ">
                    <img src="<?= htmlspecialchars($learning['thumbnail']); ?>" alt="Learning Thumbnail" class="square-img">
                </div>
                <form id="myForm<?= $index ?>" action="index.php" method="get">
                    <input type="hidden" name="page" value="learningProfile">
                    <input type="hidden" name="learning" value="<?= htmlspecialchars($learning['title']); ?>">
                    <a class="form-link href="#" onclick="document.getElementById('myForm<?= $index ?>').submit(); return false;">
                        <?= htmlspecialchars($learning['title']); ?>
                    </a>
                </form>

            </div>
        <?php endforeach; ?>
    </div>

</main>