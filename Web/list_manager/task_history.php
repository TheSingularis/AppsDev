<?php require_once '../view/header.php'; ?>

<main>
    <h3>Completion History</h3>
    <?php
    require_once '../model/Calendar.php';

    $calendar = Calendar::displayHeatmap($taskId);
    echo $calendar;
    ?>
</main>

<?php require_once '../view/footer.php'; ?>
